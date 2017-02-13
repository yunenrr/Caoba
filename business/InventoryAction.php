<?php

include './InventoryBusiness.php';


if (isset($_POST['option'])) {
    $option = $_POST['option'];

    $inventoryBusiness = new InventoryBusiness();

    switch ($option) {
        case 1: // obtener todos los activos registrados
            $status = $_POST['status'];
            $array = $inventoryBusiness->getInventory($status);

            $temp = "";
            $payment = "";
            foreach ($array as $current) {
                if ($current->getPaymentbuy() == 1) {
                    $payment = "Credit";
                } else {
                    $payment = "Cash";
                }
                $temp = $temp . $current->getIdbuy() . "," . $current->getBrandbuy() . "," . $current->getModelbuy() . "," . $current->getSeriesbuy() . "," . $current->getQuantitybuy() . "," . $current->getBuydatebuy() . "," . $current->getInvoicenumberbuy() . "," . $current->getProviderbuy() . "," . $current->getPricebuy() . "," . $current->getBuyerbuy() . "," . $payment . ";";
            }//Fin del foreach
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;

        case 2:// insertar nuevos inventario
            $idInventory = $_POST['txtIdInventory'];
            $statusinventory = $_POST['status'];
            $quantityInventory = $_POST['txtQuantity'];
            echo $inventoryBusiness->insertInventory($idInventory, $quantityInventory, $statusinventory);
            break;

        case 3:// opción para eliminar un activo del inventario
//            $idInventory = $_POST['txtID'];
//            $quantityActiveInventory = $_POST['txtQuantity'];
//            if($inventoryBusiness->getActive($idInventory)>=$quantityActiveInventory){
//               echo $inventoryBusiness->deleteInventory($idInventory,$quantityActiveInventory); 
//            }else{
//                echo 'Error!! Dont have enought quantity';
//            }
            $idInventory = $_POST['txtIdInventory'];
            $quantityInventory = $_POST['txtQuantity'];
            $inventoryBusiness->insertInventoryRepair($idInventory, $quantityInventory);
            echo '1';
            break;
        case 4:
            $status = $_POST['status'];
            $array = $inventoryBusiness->getInventory($status);

            $temp = "";
            $payment = "";
            foreach ($array as $current) {
                $temp = $temp . $current->getIdbuy() . "," . $current->getBrandbuy() . "," . $current->getModelbuy() . "," . $current->getSeriesbuy() . "," . $current->getQuantitybuy() . ";";
            }//Fin del foreach
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;
    }
}

