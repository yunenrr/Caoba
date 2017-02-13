<?php

include './ServiceBusiness1.php';

$idService = (int) $_GET['id'];
$idDay = (int) $_GET['idDay'];

if (isset($idService) && isset($idDay)) {

    $result;
    $serviceBusiness = new ServiceBusiness1();

    $result = $serviceBusiness->getHourStartService($idService, $idDay);

    echo json_encode($result);
}
?>
