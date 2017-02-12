<?php

include './PurchaseBusiness.php';
include '../domain/Purchase.php';
//if (isset($_POST['tra']) && isset($_POST['se']) && isset($_POST['su']) && isset($_POST['pri']) && isset($_POST['pay'])) {
$purchaseBusiness = new PurchaseBusiness();
$purchase = new Purchase(0, $_POST['tra'], $_POST['se'], $_POST['su'], $_POST['pri'], 0, $_POST['pay']);
$purchaseBusiness->insert($purchase);

//$pu = new Purchase(0, "Swfwef", 442, "rfS", 0, 0, 0);
////$pue = new Purchase(3, "zzzdwdS", 2, "S", 89, 0, 0);
////$p->update($pue);
//$purchaseBusiness->insert($pu);
return true;
//} else {
//    return false;
////    header("location: ../presentation/PurchaseView.php?msg=Missing data!!!!");
//}
?>
