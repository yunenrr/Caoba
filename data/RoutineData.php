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
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update routine values
     * @param type $routine
     * @return type
     */
    public function updateRoutine($routine) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a routine by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteRoutine($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
