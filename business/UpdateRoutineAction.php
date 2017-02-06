<?php

include './RoutineBusiness.php';

$id = $_POST['id'];
$exercixe = $_POST['exercixe'];
$series = $_POST['series'];
$repetitions = $_POST['repetitions'];
$comment = $_POST['comment'];
$periodicity = $_POST['periodicity'];

if (isset($id) && isset($exercixe) && isset($series) && isset($repetitions) && isset($comment)) {

    $routineBusiness = new RoutineBusiness();
    $routine = new Routine($id, 0, $exercixe, $series, $repetitions, $comment, $periodicity, 0);

    if ($routineBusiness->updateRoutine($routine)) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}
?>

