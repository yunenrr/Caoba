<?php

include './BuyBusiness.php';
include '../domain/Buy.php';
include './InventoryBusiness.php';
$buyBusiness = new BuyBusiness();
$inventoryBusiness = new InventoryBusiness();

$id = $buyBusiness->getMaxId();
$buy = new Buy(0, $_POST['bra'], $_POST['mo'], $_POST['qu'], $_POST['date'], $_POST['in'], $_POST['pro'], $_POST['pri'], $_POST['bayer'], $_POST['pay'], $_POST['ser']);
$buyBusiness->insert($buy);
$inventory = new Inventory(0, $id, $_POST['status'], $_POST['qu'], $_POST['campus']);
echo $inventoryBusiness->insertNewBuy($inventory, $buy);
return true;
