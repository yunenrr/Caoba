<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Routine.php';

/**
 * Description of RoutineData
 *
 * @author luisd
 */
class RoutineData extends Connector {

    /**
     * Used to insert a new routine
     * @param type $routine
     * @return type
     */
    public function insertRoutine($routine) {

        $query = "INSERT INTO TBRoutine(idRoutine,idPersonRoutine,nameRoutine,seriesRoutine,"
                . "repetitionsRoutine,commentRoutine,muscleRoutine)"
                . "VALUES ('" . $routine->getIdRoutine() . "',"
                . "'" . $routine->getIdPersonRoutine() . "',"
                . "'" . $routine->getNameRoutine() . "',"
                . "'" . $routine->getSeriesRoutine() . "',"
                . "'" . $routine->getRepetitionsRoutine() . "',"
                . "'" . $routine->getCommentRoutine() . "',"
                . "'" . $routine->getMuscleRoutine() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Update routine values
     * @param type $routine
     * @return type
     */
    public function updateRoutine($routine) {

        $query = "UPDATE TBRoutine SET "
                . "nameRoutine = '" . $routine->getNameRoutine() . "'"
                . ",seriesRoutine ='" . $routine->getSeriesRoutine() . "'"
                . ",repetitionsRoutine = '" . $routine->getRepetitionsRoutine() . "'"
                . ",commentRoutine = '" . $routine->getCommentRoutine() . "'"
                . "WHERE idRoutine = '" . $routine->getIdRoutine() . "'";

        return $this->exeQuery($query);
    }

    /**
     * Delete a routine by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteRoutine($id) {
        $query = 'DELETE FROM TBRoutine WHERE idRoutine=' . $id;
        if ($this->exeQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Use to get the routine of the person
     * @return type
     */
    public function getAllRoutine($idPerson) {
        $query = "SELECT * FROM TBRoutine WHERE idPersonRoutine = " . $idPerson;

        $allRoutine = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allRoutine)) {
            $array[] = array("idRoutine" => $row['idRoutine'],
                "idPersonRoutine" => $row['idPersonRoutine'],
                "nameRoutine" => $row['nameRoutine'],
                "seriesRoutine" => $row['seriesRoutine'],
                "repetitionsRoutine" => $row['repetitionsRoutine'],
                "commentRoutine" => $row['commentRoutine'],
                "muscleRoutine" => $row['muscleRoutine']);
        }

        return $array;
    }

    /**
     * Use to get the max id num to the people registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("Routine");
    }

}
