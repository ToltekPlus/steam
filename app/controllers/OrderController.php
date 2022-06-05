<?php

namespace App\Controller;
use Core\View;
use App\Service\DataBuilder;
use App\Model\OrderModel;
use App\Model\TaxGameModel;

class OrderController {
    use DataBuilder;

    /**
     * @var
     */
    public $status;

    /**
     *
     */
    public function getOrder()
    {
        $json = $this->formatStringToObject($_POST);

        $fullPrice = 0;

        foreach ($json as $order) {
            $finalPrice = $order['finalPrice'];
            $fullPrice = $fullPrice + $finalPrice;
        }

        $haveEnoughMoney = $this -> checkBlance($fullPrice);

        if ($haveEnoughMoney == false) {
            $this -> status = 0;
            return;
        }

        $this -> status = 1;
        
         foreach ($json as $test) {
            $price = $test["finalPrice"];
            $id = $test["id"];
            $count = $test["count"];
            $this->сomparisonPriceBalance($id, $count, $price);
        }

        echo json_encode ($this -> status);
    }

    /**
     * @throws \Exception
     */
    public function index() {
        View::render('basket/success.php');
    }

    /**
     * @param $id
     * @param $count
     * @param $finalPrice
     * @throws \Exception
     */
    public function сomparisonPriceBalance($id, $count, $finalPrice) {
            $expense = new ExpenseController();
            $expense->dataPreparation((int) $finalPrice, '-', 2, $_SESSION['sid']);
            $this -> store($id, $count, $finalPrice);
    }

    public function checkBlance($fullPrice) {
        $expense = new ExpenseController();
        $balance = $expense->get($_SESSION['sid']) -> balance;
        return (int)$balance >= $fullPrice;
    }

    /**
     * @param $id
     * @param $count
     * @param $finalPrice
     */
    public function store($id, $count, $finalPrice)
    {
        $data = [
            'final_price' => $finalPrice,
            'count' => $count,
            'order_date' => date('Y-m-d H:i:s', time()),
            'user_id' => $_SESSION['sid'],
            'game_id' => $id
        ];

        $args = $this->dataBuilder($data);

        $order = new OrderModel();
        $order->store($args);
    }

    /**
     * @param $data
     * @return mixed
     */
    protected function formatStringToObject($data)
    {
        $obj = "";
        foreach ($data as $key => $item) {
            $obj = trim(stripcslashes(($key)));
        }

        $string = str_replace('\n', '', $obj);
        $string = rtrim($string, ',');
        $string = "[" . trim($string) . "]";
        $json = json_decode($string, true);

        return $json;
    }
}
