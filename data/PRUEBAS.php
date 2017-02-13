<?php

include '../business/BuyBusiness.php';
include '../domain/Buy.php';
$p = new BuyBusiness();

$pu = new Buy(1, "ds", "sdsd", 4, '2017-01-10', 0, "ds", 6, "0ds", 0,"ew");
$pue = new Buy(1, "test xxa", "sd434sd", 4, '2017-01-10', 0, "d434s", 6, "0ds", 0,"ew");
//$p->returnAll();

//`idbuy` int(11) NOT NULL,
//  `brandbuy` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `modelbuy` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `quantitybuy` int(11) NOT NULL,
//  `buydatebuy` date NOT NULL,
//  `invoicenumberbuy` int(11) NOT NULL,
//  `providerbuy` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `pricebuy` int(11) NOT NULL,
//  `buyerbuy` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
//  `paymentbuy` int(11) NOT NULL,
//  `seriesbuy` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
//  

$p->update($pue);
//$p->re($pue);
//$p->insert($pu);
