<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../business/PersonBusiness.php';
include '../business/InventoryBusiness.php';
$per = new PersonBusiness();
$inv = new InventoryBusiness();
//echo $per->GetAllad(0);
//$id=$inv->getMaxId();
//$inventory= new Inventory($id, '1', '2', '345', 1);
//echo $inv->insertInventory($inventory);
//$array = $inv->getInventory(2, 1);

$idInventory = 1;
$statusinventory = 2;
$quantityInventory = 3;
// $inv->getInventory(3, 1);
//echo $inventory->getIdInventory();
$array = $inv->getInventory(1);

$temp = "";
$payment = "";
foreach ($array as $current) {
    $temp = $temp . $current->getIdbuy() . "," . $current->getBrandbuy() . "," . $current->getModelbuy() . "," . $current->getSeriesbuy() . "," . $current->getQuantitybuy() . ";";
}//Fin del foreach
if (strlen($temp) > 0) {
    $temp = substr($temp, 0, strlen($temp) - 1);
}
echo $temp;
