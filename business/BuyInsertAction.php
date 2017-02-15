<?php

include './BuyBusiness.php';
include '../domain/Buy.php';
include './InventoryBusiness.php';
$buyBusiness = new BuyBusiness();
$inventoryBusiness = new InventoryBusiness();

$id = $buyBusiness->getMaxId();
$buy = new Buy(0, $_POST['bra'], $_POST['mo'], $_POST['qu'], $_POST['date'], $_POST['in'], $_POST['pro'], $_POST['pri'], $_POST['bayer'], $_POST['pay'], $_POST['ser']);
//$buy = new Buy(0, 'ded', 'sds', 222, '2017-11-11', 8888, 'hjh', 7878, 'de', 1, 123);
$buyBusiness->insert($buy);
//$buy = new Buy(0, 'a', 'a', 0, '', 90, 8, 9, 9, 0, 456);
$inventory = new Inventory(0, $id, $_POST['status'], $_POST['qu'], $_POST['campus']);
//$inventory= new Inventory(0, $id, 1, 7, 1);
echo $inventoryBusiness->insertNewBuy($inventory, $buy);
return true;
