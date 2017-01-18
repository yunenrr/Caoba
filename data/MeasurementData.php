<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Measurement.php';

/**
 * Description of MeasurementData
 *
 * @author luisd
 */
class MeasurementData extends Connector {
    //put your code here
    
     /**
     * Used to insert a new measurement
     * @param type $measurement
     * @return type
     */
    public function insertMeasurement($measurement) {
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update measurement values
     * @param type $measurement
     * @return type
     */
    public function updateMeasurement($measurement) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a measurement by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteMeasurement($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
