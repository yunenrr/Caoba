<?php

include '../data/InventoryData.php';

/**
 * Description of InventoryBusiness
 *
 * @author luisd
 */
class InventoryBusiness {

     private $inventoryData;

    public function InventoryBusiness() {
        $this->inventoryData = new InventoryData();
    }

    /**
     * Used to insert a new inventory
     * @param type $inventory
     * @return type
     */
    public function insertInventory($inventory) {
        return $this->inventoryData->insertInventory($inventory);
    }

    /**
     * Update inventory data
     * @param type $inventory inventory to keep data
     * @return type query result
     */
    public function updateInventory($inventory) {
        return $this->inventoryData->updateInventory($inventory);
    }

    /**
     * Used to delete a inventory
     * @param type $idInventory pk of the inventory to delete
     * @return type
     */
    public function deleteInventory($idInventory) {
        return $this->inventoryData->deleteInventory($idInventory);
    }
    
     /**
     * Used to delete a inventory
     * @param type $id pk of the inventory to delete
     * @return type
     */
    public function getAllInventory() {
        return $this->inventoryData->getAllInventory();
    }
    
     /**
     * Use to get the max id num to the inventory registration
     * @return type
     */
    public function getMaxId() {
        return $this->inventoryData->getMaxId();
    } 
}
