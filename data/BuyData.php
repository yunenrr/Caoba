<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';

class BuyData extends Connector {

    public function insertBuy($buy) {
        $id = $this->getMaxId();
        $query = "insert into tbbuy values(" .
                $id . ",'" .
                $buy->brandbuy . "','" .
                $buy->modelbuy . "'," .
                $buy->quantitybuy . ",'" .
                $buy->buydatebuy . "'," .
                $buy->invoicenumberbuy . ",'" .
                $buy->providerbuy . "'," .
                $buy->pricebuy . ",'" .
                $buy->buyerbuy . "'," .
                $buy->paymentbuy . ",'" .
                $buy->seriesbuy . "')";
//        echo  $query;
//        exit;
        return $this->exeQuery($query);
    }

    public function getMaxId() {
        return $this->getMaxIdTable("buy");
    }

    public function updateBuy($buy) {
        $query = "update tbbuy set brandbuy='" .
                $buy->brandbuy . "',modelbuy='" .
                $buy->modelbuy . "',quantitybuy=" .
                $buy->quantitybuy . ",buydatebuy='" .
                $buy->buydatebuy . "',invoicenumberbuy=" .
                $buy->invoicenumberbuy . ",providerbuy='" .
                $buy->providerbuy . "',pricebuy=" .
                $buy->pricebuy . ",buyerbuy='" .
                $buy->buyerbuy . "',paymentbuy=" .
                $buy->paymentbuy . ",seriesbuy='" .
                $buy->seriesbuy . "' where idbuy=" . $buy->idbuy;

        return $this->exeQuery($query);
    }

    /**
     * Función que me permite obtener el inventario por estados
     * @param type $status
     * @return array
     */
    public function returnAll($status) {
        $query = "SELECT idbuy, brandbuy, modelbuy, quantitybuy, buydatebuy, invoicenumberbuy, "
                . "providerbuy, pricebuy, buyerbuy, paymentbuy, seriesbuy,quantityinventory,idinventory, namecampus FROM tbbuy  "
                . "INNER JOIN tbinventory ON idgoodsinventory=idbuy AND statusinventory='" . $status . "' INNER JOIN tbcampus  where idcampus=locationactveinventory";
        $result = $this->exeQuery($query);
        $arrayResult = array();
        while ($row = mysqli_fetch_array($result)) {
            $array = array("idbuy" => $row['idbuy'],
                "brandbuy" => $row['brandbuy'],
                "modelbuy" => $row['modelbuy'],
                "quantitybuy" => $row['quantitybuy'],
                "buydatebuy" => $row['buydatebuy'],
                "invoicenumberbuy" => $row['invoicenumberbuy'],
                "providerbuy" => $row['providerbuy'],
                "pricebuy" => $row['pricebuy'],
                "buyerbuy" => $row['buyerbuy'],
                "paymentbuy" => $row['paymentbuy'],
                "seriesbuy" => $row['seriesbuy'],
                "quantityinventory" => $row['quantityinventory'],
                "idinventory" => $row['idinventory'],
                "namecampus" => $row['namecampus']
            );
            array_push($arrayResult, $array);
        }
        return $arrayResult;
    }

}


