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
    public function insertPersonState($dni) {
        $fetch = mysqli_fetch_array($this->exeQuery("select max(idpersonstate)as id from tbpersonstate"));
        if ($fetch['id'] == null):
            $num = 0;
        else:
            $num = ((int) $fetch['id']) + 1;
        endif;
        $query = "insert into tbpersonstate (idpersonstate,idclientpersonstate,statepersonstate) "
                . "values(" . $num . "," . $dni . ",1)";
        return $this->exeQuery($query);
    }

    /**
     * Update personState values
     * @param type $personState
     * @return type
     */
    public function updatePersonState($id) {
        $query = "select statepersonstate from tbpersonstate where idclientpersonstate=" . $id;
        $result = $this->exeQuery($query);
        $status = mysqli_fetch_array($result);
//        echo $a["statepersonstate"];
//        exit;
        //Aqui va la carne para actualizar
        if ($status["statepersonstate"] == 0) {
            $query = "update tbpersonstate set statepersonstate=1 where idclientpersonstate=" . $id;
        } else {
            $query = "update tbpersonstate set statepersonstate=0 where idclientpersonstate=" . $id;
        }
        $this->exeQuery($query);
//        echo $status["statepersonstate"];
        return $status["statepersonstate"];
    }

    /**
     * Update personState values
     * @param type $id
     * @return type
     */
    //return state or -1 if no exist
    public function getPersonStateData($id) {
        $query = "select statepersonstate from tbpersonstate" . " where idclientpersonstate=" . $id;
//        echo  $query ;
//        exit;
        $result = $this->exeQuery($query);
//        var_dump($result);
        $temp = mysqli_fetch_array($result);
//        var_dump(  $temp );
        echo $temp['statepersonstate'];
        echo "  " . $id;
//        exit;
        return $temp['statepersonstate'];
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
