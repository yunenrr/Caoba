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
     * Función que permite insertar un nuevo registro de compra o donación
     * @param type $buy
     * @return type
     */
    public function insertNewBuy($inventory, $buy) {
        return $this->inventoryData->insertNewBuy($inventory, $buy);
    }
     /**
     * Función que permite insertar un nuevo registro de robo, reparación.
     * @param type $inventory
     * @return type
     */
    public function insertNewInventory($inventory) {
        return $this->inventoryData->insertNewInventory($inventory);
    }

    /**
     * Método que verifica si el artiulo ingresado ya se encuentra registrado en el inventario
     * @param type $buy
     * @return type
     */
    public function existInventary($buy) {
        return $this->inventoryData->existInventary($buy);
    }

    /**
     * Función que me permite actualizar la informacíon de un inventario.
     * @param type $inventory
     */
    public function updateInventory($inventory) {
        return $this->inventoryData->updateIncrease($inventory);
    }

    /**
     * Función que me permite actualizar la informacíon de un inventario, para disminuir.
     * @param type $idGoods
     * @param type $quantity
     * @return type
     */
    public function updateDecrease($idinventory, $quantity) {
        return $this->inventoryData->updateDecrease($idinventory, $quantity);
    }

}
