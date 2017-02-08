<?php

include './RoutineBusiness.php';

if (isset($_POST['submit'])) {

    $indexExercixe = 0;
    if (isset($_POST['exercises'])) {
        $indexExercixe = (int) $_POST['exercises'];
    }

    $idPerson = 0;
    if (isset($_POST['idPerson'])) {
        $idPerson = (int) $_POST['idPerson'];
    }

    $namePerson = $_POST['namePerson'];

    $routineData = new RoutineBusiness();

    for ($i = 0; $i <= $indexExercixe; $i++) {

        $idRoutine = (int) $routineData->getMaxId();
        $exercixe = $_POST['exercise' . $i];
        $series = (int) $_POST['series' . $i];
        $repetitions = (int) $_POST['repetitions' . $i];
        $comment = $_POST['comment' . $i];
        $periodicityRoutine = $_POST['periodicityRoutine' . $i];
        $muscle = (int) $_POST['comboExercise' . $i];

        if ((isset($idRoutine) && is_int($idRoutine)) &&
                (isset($exercixe) && $exercixe != "") &&
                (isset($series) && is_int($series)) &&
                (isset($repetitions) && is_int($repetitions)) &&
                (isset($comment) && $comment != "") &&
                (isset($muscle) && is_int($muscle))) {

            $routine = new Routine($idRoutine, $idPerson, $exercixe, $series, $repetitions, $comment, $periodicityRoutine, $muscle);
            $routineData->insertRoutine($routine);
        }
    }

    header("location: ../presentation/Routine.php?id=" . $idPerson . "&name=" . $namePerson . "&success=INSERT");
} else {
    header("location: ../presentation/Routine.php?error=info");
}
?>