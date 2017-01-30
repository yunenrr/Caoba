<?php

include '../business/clientRecordBusiness.php'; // 
$clientRecordBusiness = new clientRecordBusiness(); //

$clientRecordBusinessArray = $clientRecordBusiness->returnsRegisteredServices('123'); //
//$clientRecordBusinessArray = $clientRecordBusinessBusiness->getreturnsRegisteredServices($_POST['dni']); //
//var_dump($clientRecordBusinessArray);

echo (json_encode($clientRecordBusinessArray ));
