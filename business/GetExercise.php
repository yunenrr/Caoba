<?php

include './ExerciseBusiness.php';

$exerciseBusiness = new ExerciseBusiness();
if(isset($_GET['id'])){
    $result = $exerciseBusiness->getExercise($_GET['id']);
}else{
    $result = $exerciseBusiness->getAllExercise();
}

echo json_encode($result);
?>