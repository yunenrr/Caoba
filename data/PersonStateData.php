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
        $fetch = mysqli_fetch_array($this->exeQuery("select max(idPersonState)as id from TBPersonState"));
        if ($fetch['id'] == null):
            $num = 0;
        else:
            $num = ((int) $fetch['id']) + 1;

        endif;


        $query = "insert into TBPersonState (idPersonState,idClientPersonState,statePersonState) "
                . "values(" . $num . "," . $personState->getIdClientPersonState() . "," . $personState->getStatePersonState() . ")";
        $query2 = "INSERT INTO mensaje VALUES ('" . $query . "');";

        $this->exeQuery($query2);

//       echo  $query;
//       exit;
        return $this->exeQuery($query);
    }

    /**
     * Update personState values
     * @param type $personState
     * @return type
     */
    public function updatePersonState($personState) {
        //Aqui va la carne para actualizar
        $query = "update TBPersonState set statePersonState=" . $personState->getStatePersonState() . " where idClientPersonState=" . $personState->getIdClientPersonState();
        return $this->exeQuery($query);
    }

    /**
     * Update personState values
     * @param type $id
     * @return type
     */
    //return state or -1 if no exist
    public function getPersonStateData($id) {
        $query = "select statePersonState from TBPersonState" . " where idClientPersonState=" . $id;
        $result = $this->exeQuery($query);
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt === 0) {
            return -1;
        } else {
            $array = mysqli_fetch_array($result);
            return $array['statePersonState'];
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
