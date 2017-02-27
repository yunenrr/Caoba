<?php

include './ServiceBusiness1.php';

$idService = $_GET['idService'];
$idCampus = $_GET['idCampus'];

if (isset($idService) && isset($idCampus)) {
    $serviceBusiness = new ServiceBusiness1();
    $result = $serviceBusiness->getScheduleService($idService, $idCampus);
    echo json_encode($result);
}
