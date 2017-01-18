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
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update inventory values
     * @param type $inventory
     * @return type
     */
    public function updateInventory($inventory) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a inventory by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteInventory($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
