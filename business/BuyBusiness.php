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
    public function returnAll($status) {
        $result = $this->buyData->returnAll($status);
        return $result;
    }

    //obtiene el id
    public function getMaxId() {
        return $this->buyData->getMaxIdTable('buy');
    }
}
