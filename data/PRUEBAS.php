<?php

include '../business/PurchaseBusiness.php';
include '../domain/Purchase.php';
$p = new PurchaseBusiness();
$pu = new Purchase(0, "Swfwef", 442, "rfS", 0, 0, 0);
$pue = new Purchase(3, "zzzdwdS", 2, "S", 89, 0, 0);
$p->update($pue);
$p->insert($pu);
