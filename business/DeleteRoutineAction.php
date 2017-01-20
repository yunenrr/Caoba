<?php

include './RoutineBusiness.php';

$id = $_POST['id'];

if (isset($id)) {

    $routineBusiness = new RoutineBusiness();
    if ($routineBusiness->deleteRoutine($id)) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}
?>
