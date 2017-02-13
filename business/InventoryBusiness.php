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
    public function insertInventory($idInventory, $quantityInventory, $status) {
        return $this->inventoryData->insertInventory($idInventory, $quantityInventory, $status);
    }
     /**
     * Used regresa el articulo en  estado de reparación a funcionamiento
     * @param type $inventory
     * @return type
     */
    public function insertInventoryRepair($inventory,$quantity) {
        return $this->inventoryData->insertInventoryRepair($inventory,$quantity);
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
    public function deleteInventory($idInventory, $quantityActiveInventory) {
        return $this->inventoryData->deleteInventory($idInventory, $quantityActiveInventory);
    }
    
     /**
     * Used to delete a inventory
     * @param type $id pk of the inventory to delete
     * @return type
     */
    public function getInventory($status) {
        return $this->inventoryData->getInventory($status);
    }
    
     /**
     * Use to get the max id num to the inventory registration
     * @return type
     */
    public function getMaxId() {
        return $this->inventoryData->getMaxId();
    } 
    /**
     * Use to get a goods
     * @return type
     */
    public function getActive($id){
        return $this->inventoryData->getActive($id);
    }
    /**
     * Use to get status
     * @return type
     */
    public function getStatus(){
        return $this->inventoryData->getStatus();
    }
}
