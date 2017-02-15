<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Inventory.php';
//include '../domain/Buy.php';

/**
 * Description of InventoryData
 *
 * @author luisd
 */
class InventoryData extends Connector {

    /**
     * Función que permite insertar un nuevo registro como compra o donación
     * @param type $inventory
     * @return type
     */
    public function insertNewBuy($inventory, $buy) {
        if (!$this->existInventary($buy)) {
            $query = "INSERT INTO tbinventory(idinventory, idgoodsinventory, statusinventory, quantityinventory, locationactveinventory)"
                    . "VALUES ('" . $this->getMaxId() . "'"
                    . ",'" . $inventory->getIdgoodsinventory() . "'"
                    . ",'" . $inventory->getStatusinventory() . "'"
                    . ",'" . $inventory->getQuantityinventory() . "'"
                    . ",'" . $inventory->getLocationActiveInventory() . "');";
            return $this->exeQuery($query);
        } else {
            return $this->updateIncrease($inventory);
        }
    }

    /**
     * Función que permite insertar un nuevo registro como compra o donación
     * @param type $inventory
     * @return type
     */
    public function insertNewInventory($inventory) {

        $query = "SELECT count(idinventory) FROM tbinventory WHERE idgoodsinventory='" . $inventory->getIdgoodsinventory() . "'"
                . "AND statusinventory='" . $inventory->getStatusinventory() . "'";
        $array = mysqli_fetch_array($this->exeQuery($query));

        echo trim($array[0]);

        if (trim($array[0]) > 0) {
            echo $array[0];

            return $this->updateIncrease($inventory);
        } else {
            echo 'inserta';
            $query ="INSERT INTO tbinventory(idinventory, idgoodsinventory, statusinventory, quantityinventory, locationactveinventory)"
                    . "VALUES ('" . $this->getMaxId() . "'"
                    . ",'" . $inventory->getIdgoodsinventory() . "'"
                    . ",'" . $inventory->getStatusinventory() . "'"
                    . ",'" . $inventory->getQuantityinventory() . "'"
                    . ",'" . $inventory->getLocationActiveInventory() . "');";
            return $this->exeQuery($query);
        }
    }

    /**
     * Método que verifica si el artiulo ingresado ya se encuentra registrado en el inventario
     * @param type $buy
     * @return type
     */
    public function existInventary($buy) {
        $query = "SELECT count(idinventory) FROM tbinventory INNER JOIN tbbuy "
                . "WHERE brandbuy ='" . $buy->brandbuy . "'"
                . "AND modelbuy='" . $buy->modelbuy . "'"
                . "AND seriesbuy='" . $buy->seriesbuy . "'"
                . "AND idbuy =idgoodsinventory"
                . " AND statusinventory =1";
        $array = mysqli_fetch_array($this->exeQuery($query));
        if (trim($array[0]) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Función que me permite actualizar la informacíon de un inventario.
     * @param type $inventory
     */
    public function updateIncrease($inventory) {
        $query = "UPDATE tbinventory SET quantityinventory= quantityinventory+" . $inventory->getQuantityinventory() . ""
                . " WHERE idgoodsinventory ='" . $inventory->getIdgoodsinventory() . "' AND statusinventory='" . $inventory->getStatusinventory() . "'";

        return $this->exeQuery($query);
    }

    /**
     * Función que me permite actualizar la informacíon de un inventario, para disminuir.
     * @param type $idinventory
     * @param type $quantity
     * @return type
     */
    public function updateDecrease($idinventory, $quantity) {
        $query = "UPDATE tbinventory SET quantityinventory= quantityinventory-" . $quantity . ""
                . " WHERE idinventory ='" . $idinventory . "'";
        echo $this->exeQuery($query);
        echo 'yyyy';
        $query = "SELECT quantityinventory FROM tbinventory WHERE idinventory ='" . $idinventory . "'";
        $array = mysqli_fetch_array($this->exeQuery($query));
        if (trim($array[0]) <= 0) {
            $query = "DELETE FROM tbinventory WHERE idinventory ='" . $idinventory . "'";
            return $this->exeQuery($query);
        } else {
            return 1;
        }
    }

    /**
     * 
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("inventory");
    }

}
