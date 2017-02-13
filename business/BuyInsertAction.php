<?php

include './BuyBusiness.php';
include '../domain/Buy.php';
$buyBusiness = new BuyBusiness();
$buy = new Buy(0, $_POST['bra'], $_POST['mo'], $_POST['qu'], '2017-01-10', $_POST['in'], $_POST['pro'], $_POST['pri'], "0dsd", $_POST['pay'], $_POST['ser']);
$buyBusiness->insert($buy);
return true;
