<?php
include './PurchaseBusiness.php';
$purchase = new PurchaseBusiness();
$result = $purchase->returnAll();
echo (json_encode($result));

