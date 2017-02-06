<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Exercise.php';

class ExerciseData extends Connector {

    /**
     * Used to insert a new exercise
     * @param type $exercise
     * @return type
     */
    public function insertExercise($exercise) {

        $query = "insert into tbexercise(idexercise,nameexercise)"
                . "values ('" . $exercise->getIdExercise() . "',"
                . "'" . $exercise->getNameExercise() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Update exercise values
     * @param type $exercise
     * @return type
     */
    public function updateExercise($exercise) {

        $query = "update tbexercise set "
                . "nameexercise = '" . $exercise->getNameExercise() . "'"
                . "WHERE idexercise = '" . $exercise->getIdExercise() . "'";

        return $this->exeQuery($query);
    }

    /**
     * Delete a exercise by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteExercise($id) {
        $query = 'delete from tbexercise where idexercise=' . $id;
        if ($this->exeQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Use to get the exercise
     * @return type
     */
    public function getAllExercise() {
        $query = "select * from tbexercise";

        $allRoutine = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allRoutine)) {
            $array[] = array("idexercise" => $row['idexercise'], "nameexercise" => $row['nameexercise']);
        }

        return $array;
    }

    /**
     * Use to get the exercise
     * @return type
     */
    public function getExercise($id) {
        $query = "select * from tbexercise where idexercise = " . $id;

        $allRoutine = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allRoutine)) {
            $array[] = array("idexercise" => $row['idexercise'], "nameexercise" => $row['nameexercise']);
        }

        return $array;
    }

    /**
     * Use to get the max id num to the exercise registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("exercise");
    }

}
