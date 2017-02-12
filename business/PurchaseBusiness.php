<?php

include '../data/PurchaseData.php';

class PurchaseBusiness {

    private $purchaseData;

    //constructor
    public function PurchaseBusiness() {
        $this->purchaseData = new PurchaseData();
    }

    //inserta en base de datos
    public function insert($purchase) {
        $result = $this->purchaseData->insertPurchase($purchase);
        return $result;
    }

    //inserta en base de datos
    public function update($purchase) {
        $result = $this->purchaseData->updatePurchase($purchase);
        return $result;
    }

    //inserta en base de datos
    public function returnAll() {
        $result = $this->purchaseData->returnAll();
        return $result;
    }

}
