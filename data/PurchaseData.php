<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';

//include '../domain/Condition.php';

class PurchaseData extends Connector {

    public function insertPurchase($purchase) {
        $id = $this->getMaxId();
        $query = "insert into tbpurchase values(" .
                $id . ",'" .
                $purchase->getTrademarkpurchase() . "'," .
                $purchase->getSeriepurchase() . ",'" .
                $purchase->getSupplierpurchase() . "'," .
                $purchase->getPricepurchase() . "," .
                $purchase->getIdbuyerpurchase() . "," .
                $purchase->getIdpaymenttypepurchase() . ")";
//        echo $query;
//        exit;
        return $this->exeQuery($query);
    }

    public function getMaxId() {
        return $this->getMaxIdTable("purchase");
    }

    public function updatePurchase($purchase) {

        $query = "update tbpurchase set trademarkpurchase='" .
                $purchase->getTrademarkpurchase() . "',seriepurchase=" .
                $purchase->getSeriepurchase() . ",supplierpurchase='" .
                $purchase->getSupplierpurchase() . "',pricepurchase=" .
                $purchase->getPricepurchase() . ",idbuyerpurchase=" .
                $purchase->getIdbuyerpurchase() . ",idpaymenttypepurchase=" .
                $purchase->getIdpaymenttypepurchase() . " where idpurchase=" . $purchase->getIdpurchase();
        return $this->exeQuery($query);
    }

    public function returnAll() {
        $query = "select * from tbpurchase";
        $result = $this->exeQuery($query);
        $arrayResult = array();
        while ($row = mysqli_fetch_array($result)) {
            $array = array("idpurchase" => $row['idpurchase'],
                "trademarkpurchase" => $row['trademarkpurchase'],
                "seriepurchase" => $row['seriepurchase'],
                "supplierpurchase" => $row['supplierpurchase'],
                "pricepurchase" => $row['pricepurchase'],
                "idbuyerpurchase" => $row['idbuyerpurchase'],
                "idpaymenttypepurchase" => $row['idpaymenttypepurchase']
            );
            array_push($arrayResult, $array);
        }
        return $arrayResult;
    }

}
