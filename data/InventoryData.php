<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Inventory.php';
include '../domain/Buy.php';

/**
 * Description of InventoryData
 *
 * @author luisd
 */
class InventoryData extends Connector {

    /**
     * Used to insert a new inventory
     * @param type $inventory
     * @return type
     */
    public function insertInventory($idInventory, $quantity, $status) {
        $query = "SELECT idgoodsinventory  FROM tbinventory WHERE idinventory=" . $idInventory . "";
        $arrayId = mysqli_fetch_array($this->exeQuery($query));
        $Idgoodsinventory = trim($arrayId[0]);
        $query = "SELECT count(idgoodsinventory) FROM tbinventory WHERE idgoodsinventory ='" . $Idgoodsinventory . "' AND statusinventory='" . $status . "'";
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        if (trim($array[0]) > 0) {

            $query = "UPDATE tbinventory SET quantityinventory= quantityinventory+" . $quantity . ""
                    . " WHERE idgoodsinventory ='" . $Idgoodsinventory . "' AND statusinventory='" . $status . "'";
            $this->exeQuery($query);
        } else {
            $query = "INSERT INTO `tbinventory`(`idinventory`, `idgoodsinventory`, `statusinventory`, `quantityinventory`, `locationactveinventory`)"
                    . "VALUES ('" . $this->getMaxId() . "'"
                    . ", '" . $Idgoodsinventory . "'"
                    . ",'" . $status . "'"
                    . ",'" . $quantity . "','');";
            $this->exeQuery($query);
        }
        $query = "UPDATE tbinventory SET quantityinventory= quantityinventory-" . $quantity . ""
                . " WHERE idinventory ='" . $idInventory . "'";
        return $this->exeQuery($query);
    }

    /**
     * Used to insert a new inventory
     * @param type $inventory
     * @return type
     */
    public function insertInventoryRepair($idInventory, $quantity) {

        $query = "UPDATE tbinventory SET quantityinventory= quantityinventory-" . $quantity . ""
                . " WHERE idinventory ='" . $idInventory . "'";
        $this->exeQuery($query);

        $query = "SELECT idgoodsinventory  FROM tbinventory WHERE idinventory=" . $idInventory . "";
        $arrayId = mysqli_fetch_array($this->exeQuery($query));
        $Idgoodsinventory = trim($arrayId[0]);
        $query = "UPDATE tbinventory SET quantityinventory= quantityinventory+" . $quantity . ""
                . " WHERE idgoodsinventory ='" . $Idgoodsinventory . "' AND statusinventory='1'";
        $this->exeQuery($query);

        $query = "SELECT quantityinventory FROM tbinventory WHERE idinventory='" . $idInventory . "'";
        $array = mysqli_fetch_array($this->exeQuery($query));
        if (trim($array[0]) <= 0) {
            $query = "DELETE FROM tbinventory WHERE idinventory = '" . $idInventory . "';";
            return $this->exeQuery($query);
        } else {
            return 'mier';
        }
    }

    /**
     * Update inventory values
     * @param type $inventory
     * @return type
     */
    public function updateInventory($inventory) {
        $query = "UPDATE TBInventory SET "
                . "`nameActiveInventory`  = '" . $inventory->getNameActiveInventory() . "'"
                . ",`quantityInventory` = '" . $inventory->getQuantityInventory() . "'"
                . ",`priceInventory` = '" . $inventory->getPriceInventory() . "'"
                . ",`registrationDateInventory` = '" . $inventory->getRegistrationDateInventory() . "'"
                . ",`codeActiveInventory` = '" . $inventory->getCodeActiveInventory() . "'"
                . ",`locationActveInventory` = '" . $inventory->getLocationActiveInventory() . "'"
                . " WHERE idInventory = '" . $inventory->getIdInventory() . "'";
        return $this->exeQuery($query);
    }

    /**
     * Delete a inventory by id
     * @param type $codeActiveInventory pk of the element to delete
     * @return type
     */
    public function deleteInventory($idinventory, $quantity) {
        $query = "UPDATE tbinventory SET quantityinventory= quantityinventory-" . $quantity . ""
                . " WHERE `idinventory` = '" . $idinventory . "' AND `quantityinventory` > 0";
        return $this->exeQuery($query);
    }

    /**
     * get all inventory by status
     * @return type
     */
    public function getInventory($status) {
        $query = "SELECT idInventory, brandbuy, modelbuy, quantityinventory, buydatebuy, "
                . "invoicenumberbuy, providerbuy, pricebuy, buyerbuy, paymentbuy, seriesbuy "
                . "FROM tbbuy INNER JOIN tbinventory ON idbuy=`idgoodsinventory` where statusinventory='" . $status . "' AND quantityinventory>0";

        $result = $this->exeQuery($query);
        $array = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $buy = new Buy($row['idInventory'], $row['brandbuy'], $row['modelbuy'], $row['quantityinventory'], $row['buydatebuy'], $row['invoicenumberbuy'], $row['providerbuy'], $row['pricebuy'], $row['buyerbuy'], $row['paymentbuy'], $row['seriesbuy']);
                array_push($array, $buy);
            }//Fin del while
        }//Fin del if
        return $array;
    }

    /**
     * Use to get the max id num to the inventory registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("Inventory");
    }

    /**
     * Use to get a specif active
     * @param type $id
     * @return \Person
     */
    public function getActive($id) {
        $query = "SELECT `quantityinventory` FROM `tbinventory` WHERE `idinventory`=" . $id;
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        return trim($array[0]);
    }

    /**
     * Use to get all status
     * @param type $id
     * @return \Person
     */
    public function getStatus() {
        $query = "SELECT `idstatusgoods`, `statusstatusgoods` FROM `tbstatusgoods` WHERE 1";
        $result = $this->exeQuery($query);
        $array = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($array, $row['idstatusgoods'], $row['statusstatusgoods']);
            }//Fin del while
        }//Fin del if
        return $array;
    }

}
