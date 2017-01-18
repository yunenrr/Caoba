<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/PersonState.php';

/**
 * Description of PersonStateData
 *
 * @author luisd
 */
class PersonStateData extends Connector {

    /**
     * Used to insert a new personState
     * @param type $personState
     * @return type
     */
    public function insertPersonState($personState) {
        $fetch = mysqli_fetch_array($this->exeQuery("select max(id)as id from TBPersonState"));
        $num = ((int) $fetch['id']) + 1;
        $query = "insert into TBPersonState (id,idPerson,state)"
                . "values (" . $num . "," . $personState->idPerson . "," . $personState->state . ")";
        return $this->exeQuery($query);
    }

    /**
     * Update personState values
     * @param type $personState
     * @return type
     */
    public function updatePersonState($personState) {
        //Aqui va la carne para actualizar
        $query = "update TBPersonState set state=" . $personState->state . " where idPerson=" . $personState->idPerson;
        return $this->exeQuery($query);
    }

    /**
     * Update personState values
     * @param type $id
     * @return type
     */
    //return state or -1 if no exist
    public function getPersonStateData($id) {
        $query = "select state from TBPersonState" . " where idPerson=" . $id;
        $result = $this->exeQuery($query);
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt === 0) {
            return -1;
        } else {
            $array = mysqli_fetch_array($result);
            return $array['state'];
        }
    }

    /**
     * Delete a personState by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deletePersonState($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
