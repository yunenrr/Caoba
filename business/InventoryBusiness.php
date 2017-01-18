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
     * @param type $id pk of the inventory to delete
     * @return type
     */
    public function deleteInventory($id) {
        return $this->inventoryData->deleteInventory($id);
    }
    
}
