<?php

include './ExerciseBusiness.php';

if (isset($_POST['submit'])) {
    $name = $_POST['exercise'];
    if (isset($name) && $name !== '') {
        $exerciseBusiness = new ExerciseBusiness();
        $exercise = new Exercise($exerciseBusiness->getMaxId(), $name);
        if ($exerciseBusiness->insertExercise($exercise)) {
            header("location: ../presentation/CreateNewExercise.php?success=INSERT");
        } else {
            header("location: ../presentation/CreateNewExercise.php?error=INSERT");
        }
    } else {
        header("location: ../presentation/CreateNewExercise.php?error=NAME_NULL");
    }
} else {
    header("location: ../presentation/CreateNewExercise.php?error=submit");
}

