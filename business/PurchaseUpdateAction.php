<?php

$id = $_POST['id'];
include './PurchaseBusiness.php';
include '../domain/Purchase.php';
//if (isset($_POST['id']) && isset($_POST['trademark' . $id]) && isset($_POST['serie' . $id]) && isset($_POST['suplier' . $id]) && isset($_POST['price' . $id]) && isset($_POST['paymenttype' . $id])) {
$purchaseBusiness = new PurchaseBusiness();
$purchase = new Purchase($id, $_POST['tra' ], (int) $_POST['se' ], $_POST['su' ], (int) $_POST['pri' ], 0, $_POST['pay']);
$purchaseBusiness->update($purchase);
return true;
//} else {
//    return false;
////    header("location: ../presentation/PurchaseView.php?msg=Missing data!!!!");
//}
?>