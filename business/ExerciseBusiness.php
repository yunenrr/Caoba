<?php

include '../data/ExerciseData.php';

class ExerciseBusiness {

    private $exerciseData;

    function ExerciseBusiness() {
        return $this->exerciseData = new ExerciseData();
    }

    /**
     * Used to insert a new exercise
     * @param type $exercise
     * @return type
     */
    public function insertExercise($exercise) {
        return $this->exerciseData->insertExercise($exercise);
    }

    /**
     * Update exercise values
     * @param type $exercise
     * @return type
     */
    public function updateExercise($exercise) {
        return $this->exerciseData->updateExercise($exercise);
    }

    /**
     * Delete a exercise by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteExercise($id) {
        return $this->exerciseData->deleteExercise($id);
    }

    /**
     * Use to get the exercise
     * @return type
     */
    public function getAllExercise() {
        return $this->exerciseData->getAllExercise();
    }

    /**
     * Use to get the exercise
     * @return type
     */
    public function getExercise($id) {
        return $this->exerciseData->getExercise($id);
    }

    /**
     * Use to get the max id num to the exercise registration
     * @return type
     */
    public function getMaxId() {
        return $this->exerciseData->getMaxId();
    }

}
