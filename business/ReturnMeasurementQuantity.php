<?php

include './MeasurementBusiness.php';
$measurementBusiness = new MeasurementBusiness();
//$mea = $measurementBusiness->returnMeasurementQuantity(2);
$mea = $measurementBusiness->returnMeasurementQuantity($_POST['id']);
echo json_encode($mea);
//echo true;

