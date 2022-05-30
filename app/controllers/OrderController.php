<?php

namespace App\Controller;
use Core\View;
use App\Service\DataBuilder;
use App\Model\OrderModel;
use App\Model\TaxGameModel;

class OrderController {
    use DataBuilder;

    public function getOrder()
    {
        $test = ['id' => 1, 'count' => 1, 'finalPrice' => 3499];
        $price = $test['finalPrice'];
        $id = $test['id'];
        $count = $test['count'];

        $taxPrice = $this -> get_taxPrice($id, $price);
        $this -> сomparisonPriceBalance($id, $count, $taxPrice);
    }

    public function сomparisonPriceBalance($id, $count, $finalPrice) {
        $expense = new ExpenseController();
        $balance = $expense->get($_SESSION['sid']) -> balance;
        var_dump($finalPrice);
        if((int)$balance < $finalPrice){
            var_dump("Денег нема");
            
        }else{ 
            $expense->dataPreparation((int) $finalPrice, '-', 2, $_SESSION['sid']);    
            $this -> store($id, $count, $finalPrice);
        }
    }

    public function get_taxPrice($id, $price)
    {
        $tax = new CartController;
        $game_tax = 1 - $tax->game_tax($id);
        $taxPrice = round($price * $game_tax);
        return $taxPrice;
    }



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
}
