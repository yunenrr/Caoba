<?php

include '../business/FamilyParentingBusiness.php';
$b= new FamilyParentingBusiness();
echo $b->verifyFamily(1);
