<?php

include './ServiceBusiness1.php';

$idService = (int) $_GET['id'];
$idDay = (int) $_GET['idDay'];
$condiction = (int) $_GET['condiction'];

if (isset($idService) || isset($idDay) && isset($condiction)) {

    $result;
    $serviceBusiness = new ServiceBusiness1();

    if ($condiction == "0") {
        $result = $serviceBusiness->getHourStartService($idService, $idDay);
    }else{
        $result = $serviceBusiness->getHourEndService($idDay);
    }

    echo json_encode($result);
}
?>
