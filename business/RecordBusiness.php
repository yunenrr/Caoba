<?php

include '../data/RecordData.php';

/**
 * Description of RecordBusiness
 *
 * @author luisd
 */
class RecordBusiness {

    private $recordData;

    public function RecordBusiness() {
        return $this->recordData = new RecordData();
    }

    /**
     * Used to insert a new record
     * @param type $record
     * @return type
     */
    public function insertRecord($record) {
        return $this->recordData->inserRecord($record);
    }

    /**
     * Update record data
     * @param type $record record to keep data
     * @return type query result
     */
    public function updateRecord($record) {
        return $this->recordData->updateRecord($record);
    }

    /**
     * Used to delete a record
     * @param type $id pk of the record to delete
     * @return type
     */
    public function deleteRecord($id) {
        return $this->recordData->deleteRecord($id);
    }

}
