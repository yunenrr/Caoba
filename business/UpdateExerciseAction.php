<?php

include './ExerciseBusiness.php';

if (isset($_POST['submit'])) {
    $name = $_POST['exercise'];
    $id = $_POST['idexercise'];
    if (isset($name) && isset($id) && $id !== '-1') {
        $exerciseBusiness = new ExerciseBusiness();
        $exercise = new Exercise($id, $name);
        if ($exerciseBusiness->updateExercise($exercise)) {
            header("location: ../presentation/UpdateExercise.php?success=UPDATE");
        } else {
            header("location: ../presentation/UpdateExercise.php?error=UPDATE");
        }
    } else {
        header("location: ../presentation/UpdateExercise.php?error=ISSET");
    }
} else {
    header("location: ../presentation/UpdateExercise.php?error=submit");
}