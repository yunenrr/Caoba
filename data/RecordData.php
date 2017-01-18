<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Record.php';

/**
 * Description of RecordData
 *
 * @author luisd
 */
class RecordData extends Connector {
    
     /**
     * Used to insert a new record
     * @param type $record
     * @return type
     */
    public function insertRecord($record) {
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update record values
     * @param type $record
     * @return type
     */
    public function updateRecord($record) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a record by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteRecord($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
