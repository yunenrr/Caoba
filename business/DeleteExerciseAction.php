<?php

include './ExerciseBusiness.php';

if (isset($_POST['submit'])) {
    $id = $_POST['idexercise'];
    if (isset($id) && $id !== '-1') {
        $exerciseBusiness = new ExerciseBusiness();
        if ($exerciseBusiness->deleteExercise($id)) {
            header("location: ../presentation/DeleteExercise.php?success=DELETE");
        } else {
            header("location: ../presentation/DeleteExercise.php?error=DELETE");
        }
    } else {
        header("location: ../presentation/DeleteExercise.php?error=ISSET");
    }
} else {
    header("location: ../presentation/DeleteExercise.php?error=submit");
}