<?php

include '../business/MeasurementBusiness.php'; // bussiness include
$measurementBusiness = new MeasurementBusiness(); //Instance  bussiness
//$measurementArray = [];
//$measurementArray = $measurementBusiness->getMeasurementByClientId(306363); //Returns clients
$measurementArray = $measurementBusiness->getMeasurementByClientId($_POST['dni']); //Returns clients
//var_dump($measurementArray);
echo (json_encode($measurementArray));
