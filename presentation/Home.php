<?php
//
include '../business/MeasurementBusiness.php'; //person bussiness include
//include '../business/PersonStateBusiness.php'; //personState bussiness include
$personBusiness = new MeasurementBusiness(); //Instance of person bussiness
$personBusiness->getMeasurementByClientId(306363); //Returns clients

include './header.php';
?>

<?php

include './footer.php';
?>