<?php

include '../business/InventoryBusiness.php';
$inventoryBusiness = new InventoryBusiness();
$codeActiveInventory = 78;
$nameActiveInventory = 'a';
$quantityActiveInventory = 9;
$priceActiveInventory = 9;
$registrationDateInventory ='2017-01-12';
$locationActiveInventory = 'jkjk';
$idInventory = $inventoryBusiness->getMaxId();


$inventory = new Inventory($idInventory, $nameActiveInventory, $quantityActiveInventory, $priceActiveInventory, $registrationDateInventory, $codeActiveInventory, $locationActiveInventory);
//$inventoryBusiness->insertInventory($inventory);
$inventoryBusiness->deleteInventory('78', 10);
