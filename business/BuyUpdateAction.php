<?php

include './BuyBusiness.php';
include '../domain/Buy.php';

$buyBusiness = new BuyBusiness();
//   public $idbuy;
//    public $brandbuy;
//    public $modelbuy;
//    public $quantitybuy;
//    public $buydatebuy;
//    public $invoicenumberbuy;
//    public $providerbuy;
//    public $pricebuy;
//    public $buyerbuy;
//    public $paymentbuy;
//    public $seriesbuy;

$id = $_POST['id'];
$pue = new Buy($id, $_POST['bra'], $_POST['mo'], $_POST['qu'], '2017-01-10',$_POST['in'], $_POST['pro'], $_POST['pri'], "0ds", $_POST['pay'], $_POST['ser']);
$buyBusiness->update($pue);

return true;
?>
