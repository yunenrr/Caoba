<?php

include './RoutineBusiness.php';

$idPerson = (int) $_GET['id'];
if (isset($idPerson)) {
    $routineData = new RoutineBusiness();
    $result = $routineData->getAllRoutine($idPerson);
    echo json_encode($result);
}
?>
