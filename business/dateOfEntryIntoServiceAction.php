<?php

include '../business/clientRecordBusiness.php'; // 
$clientRecordBusiness = new clientRecordBusiness(); //

$clientRecordBusinessArray = $clientRecordBusiness->dateOfEntryIntoService('123'); //
//$clientRecordBusinessArray = $clientRecordBusinessBusiness->dateOfEntryIntoService($_POST['dni']); //
echo (json_encode($clientRecordBusinessArray));
