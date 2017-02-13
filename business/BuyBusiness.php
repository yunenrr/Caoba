<?php

include '../data/BuyData.php';

class BuyBusiness {

    private $buyData;

    //constructor
    public function BuyBusiness() {
        $this->buyData = new BuyData();
    }

    //inserta en base de datos
    public function insert($buy) {
        $result = $this->buyData->insertBuy($buy);
        return $result;
    }

    //inserta en base de datos
    public function update($buy) {
        $result = $this->buyData->updateBuy($buy);
        return $result;
    }

    //inserta en base de datos
    public function returnAll() {
        $result = $this->buyData->returnAll();
        return $result;
    }

}
