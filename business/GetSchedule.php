<?php

include './ScheduleClientBusiness.php';

$idClient = (int) $_GET['idClient'];
$idService = (int) $_GET['idService'];

if (isset($idClient) && isset($idService)) {
    $scheduleBusiness = new ScheduleClientBusiness();
    $result = "";

    if ($idService != "-2") {

        if ($idService != "-1") {
            $result = $scheduleBusiness->getSchedule($idClient, $idService);
        } else {
            $result = $scheduleBusiness->getAllSchedule($idClient);
        }
        echo json_encode($result);
    }
}
