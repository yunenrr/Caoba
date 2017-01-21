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

        date_default_timezone_set("America/Costa_Rica");
        $time = time();
        $date = date("Y-m-d ", $time) . "";
        $query = "INSERT INTO TBMeasurement VALUES(" .
                $measurement->getIdMeasurement() . ",'" .
                $measurement->getIdPersonMeasurement() . "','" .
                $date . "'," .
                $measurement->getTransverseThoraxMeasurement() . "," .
                $measurement->getBackThoraxMeasurement() . "," .
                $measurement->getBiiliocrestideoMeasurement() . "," .
                $measurement->getHumeralMeasurement() . "," .
                $measurement->getFemoralMeasurement() . "," .
                $measurement->getHeadMeasurement() . "," .
                $measurement->getArmRelaxedMeasurement() . "," .
                $measurement->getArmFlexedMeasurement() . "," .
                $measurement->getForearmMeasurement() . "," .
                $measurement->getMesosternalThoraxMeasurement() . "," .
                $measurement->getWaistMeasurement() . "," .
                $measurement->getHipMeasurement() . "," .
                $measurement->getInnerThighMeasurement() . "," .
                $measurement->getUpperThighMeasurement() . "," .
                $measurement->getCalfMaxMeasurement() . "," .
                $measurement->getTricepsMeasurement() . "," .
                $measurement->getSubscapularMeasurement() . "," .
                $measurement->getSupraspiralMeasurement() . "," .
                $measurement->getAbdominalMeasurement() . "," .
                $measurement->getMedialThighMeasurement() . "," .
                $measurement->getCalfMeasurement() .
                ");";
//        ECHO $query;
//        EXIT;
        $query2 = "INSERT INTO mensaje VALUES ('" . $query . "')";
        $this->exeQuery($query2);
        $query2 = "INSERT INTO mensaje VALUES ('c" . $measurement->getMeasurementDateMeasurement() . "')";
        $this->exeQuery($query2);
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
