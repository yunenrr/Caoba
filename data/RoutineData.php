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

        $query = "insert into tbroutine(idroutine,idpersonRoutine,nameroutine,seriesroutine,"
                . "repetitionsroutine,commentroutine,periodicityroutine, muscleroutine)"
                . "values ('" . $routine->getIdRoutine() . "',"
                . "'" . $routine->getIdPersonRoutine() . "',"
                . "'" . $routine->getNameRoutine() . "',"
                . "'" . $routine->getSeriesRoutine() . "',"
                . "'" . $routine->getRepetitionsRoutine() . "',"
                . "'" . $routine->getCommentRoutine() . "',"
                . "'" . $routine->getPeriodicityRoutine() . "',"
                . "'" . $routine->getMuscleRoutine() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Update routine values
     * @param type $routine
     * @return type
     */
    public function updateRoutine($routine) {

        $query = "update tbroutine set "
                . "nameroutine = '" . $routine->getNameRoutine() . "'"
                . ",seriesroutine ='" . $routine->getSeriesRoutine() . "'"
                . ",repetitionsroutine = '" . $routine->getRepetitionsRoutine() . "'"
                . ",commentroutine = '" . $routine->getCommentRoutine() . "'"
                . ",periodicityroutine = '" . $routine->getPeriodicityRoutine() . "'"
                . "where idroutine = '" . $routine->getIdRoutine() . "'";

        return $this->exeQuery($query);
    }

    /**
     * Delete a routine by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteRoutine($id) {
        $query = 'delete from tbroutine where idroutine=' . $id;
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
        $query = "select * from tbroutine where idpersonroutine = " . $idPerson;

        $allRoutine = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allRoutine)) {
            $array[] = array("idRoutine" => $row['idroutine'],
                "idPersonRoutine" => $row['idpersonroutine'],
                "nameRoutine" => $row['nameroutine'],
                "seriesRoutine" => $row['seriesroutine'],
                "repetitionsRoutine" => $row['repetitionsroutine'],
                "commentRoutine" => $row['commentroutine'],
                "periodicityRoutine" => $row['periodicityroutine'],
                "muscleRoutine" => $row['muscleroutine']);
        }

        return $array;
    }

    /**
     * Use to get the max id num to the people registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("routine");
    }

}
