<?php

include './InventoryBusiness.php';


if (isset($_POST['option'])) {
    $option = $_POST['option'];

    $inventoryBusiness = new InventoryBusiness();

    switch ($option) {
        case 1: // obtener todos los activos registrados
            $array = $inventoryBusiness->getAllInventory();
            
            $temp = "";
            foreach ($array as $current) {
                $temp = $temp . $current->getIdInventory() . "," . $current->getCodeActiveInventory() . "," . $current->getNameActiveInventory() . "," . $current->getQuantityInventory() . "," . $current->getPriceInventory() . "," . $current->getRegistrationDateInventory() . "," . $current->getLocationActiveInventory() . ";";
            }
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;

        case 2:// insertar nuevos activos
            $codeActiveInventory = $_POST['txtCode'];
            $nameActiveInventory = $_POST['txtName'];
            $quantityActiveInventory = $_POST['txtQuantity'];
            $priceActiveInventory = $_POST['txtPrice'];
            $registrationDateInventory = $_POST['txtDate'];
            $locationActiveInventory = $_POST['txtLocation'];
            $idInventory = $inventoryBusiness->getMaxId();

            $inventory = new Inventory($idInventory, $nameActiveInventory, $quantityActiveInventory, $priceActiveInventory, $registrationDateInventory, $codeActiveInventory, $locationActiveInventory);
            $inventoryBusiness->insertInventory($inventory);
            break;

        case 3:// opción para eliminar un activo del inventario
            $idInventory = mysql_real_escape_string(htmlspecialchars($_POST['txtID']));
            echo $inventoryBusiness->deleteInventory($idInventory);
            break;

        case 4:// opción para actualizar la información de un activo
            $codeActiveInventory = $_POST['txtCode'];
            $nameActiveInventory = $_POST['txtName'];
            $quantityActiveInventory = $_POST['txtQuantity'];
            $priceActiveInventory = $_POST['txtPrice'];
            $registrationDateInventory = $_POST['txtDate'];
            $locationActiveInventory = $_POST['txtLocation'];
            $idInventory = $_POST['txtID'];
            $inventory = new Inventory($idInventory, $nameActiveInventory, $quantityActiveInventory, $priceActiveInventory, $registrationDateInventory, $codeActiveInventory, $locationActiveInventory);
            echo $inventoryBusiness->updateInventory($inventory);
            break;
    }
}

