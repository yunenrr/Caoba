<?php

include './ScheduleClientBusiness.php';

$idClient = $_GET['idClient'];

if (isset($idClient)) {
    $scheduleBusiness = new ScheduleClientBusiness();
    $result = $scheduleBusiness->getScheduleClient($idClient);
    echo json_encode($result);
}
