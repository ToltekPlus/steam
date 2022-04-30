<?php

namespace App\Controller;

use App\Service\DataBuilder;
use App\Model\RefoundModel;

class RefoundController{
    use DataBuilder;

   /**
     * @return void
     */
    public function store()
    {
        $args = $this->dataBuilder($_POST);

        $refund_orders = new RefoundModel();
        $refund_orders->store($args);
    }
}