<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Inventory.php';

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
    public function insertInventory($inventory) {
        $query = "INSERT INTO TBInventory (`idInventory`, `nameActiveInventory`, `quantityInventory`, `priceInventory`, `registrationDateInventory`, `codeActiveInventory`, `locationActveInventory`)"
                . "VALUES ('" . $inventory->getIdInventory() . "'"
                . ", '" . $inventory->getNameActiveInventory() . "'"
                . ",'" . $inventory->getQuantityInventory() . "'"
                . ",'" . $inventory->getPriceInventory() . "'"
                . ",'" . $inventory->getRegistrationDateInventory() . "'"
                . ",'" . $inventory->getCodeActiveInventory() . "'"
                . ",'" . $inventory->getLocationActiveInventory() . "');";

        return $this->exeQuery($query);
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
     * @param type $idInventory pk of the element to delete
     * @return type
     */
    public function deleteInventory($idInventory) {
        $query = 'DELETE FROM TBInventory WHERE idInventory=' . $idInventory;
        if ($this->exeQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * get all active inventory
     * @return type
     */
    public function getAllInventory() {
        $query = "SELECT `idInventory`, `nameActiveInventory`, `quantityInventory`, "
                . "`priceInventory`, `registrationDateInventory`, `codeActiveInventory`, "
                . "`locationActveInventory` "
                . "FROM TBInventory;";
        $result = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentInventory = new Inventory($row['idInventory'], $row['nameActiveInventory'], $row['quantityInventory'], $row['priceInventory'], $row['registrationDateInventory'], $row['codeActiveInventory'], $row['locationActveInventory']);

            array_push($array, $currentInventory);
        }
        return $array;
    }

    /**
     * Use to get the max id num to the inventory registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("Inventory");
    }

}
