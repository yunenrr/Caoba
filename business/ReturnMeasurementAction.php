<?php
include '../business/MeasurementBusiness.php'; // bussiness include
$measurementBusiness = new MeasurementBusiness(); //Instance  bussiness
$measurementArray = $measurementBusiness->getMeasurementByClientId($_POST['id']); //Returns clients
//$measurementArray = $measurementBusiness->getMeasurementByClientId(0); //Returns clients
//var_dump($measurementArray);
echo (json_encode($measurementArray));
