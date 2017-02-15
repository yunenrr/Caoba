<?php

include './InventoryBusiness.php';
include './BuyBusiness.php';


if (isset($_POST['option'])) {
    $option = $_POST['option'];

    $inventoryBusiness = new InventoryBusiness();

    switch ($option) {
        case 1: // robo
            $idInventory = $_POST['id'];
            $quantity = $_POST['quantity'];
            $inventory = new Inventory(0, $idInventory, 5, $quantity, 0);
            $inventoryBusiness->insertNewInventory($inventory);
            $inventoryBusiness->updateDecrease($idInventory, $quantity);
            break;

        case 2:// obtiene elementos del inventario para robado
            $buy = new BuyBusiness();
            $result = $buy->returnAllForStolen();
            echo (json_encode($result));
            break;

        case 3:
            $idBuy = $_POST['id'];
            $idInventory = $_POST['idInventory'];
            $quantity = $_POST['quantity'];
            $sta = $_POST['status'];
            $inventory = new Inventory(0, $idBuy, $sta, $quantity, 0);
            $inventoryBusiness->insertNewInventory($inventory);
            $inventoryBusiness->updateDecrease($idInventory, $quantity);
            break;
    }
}

