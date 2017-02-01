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
        $query = "INSERT INTO tbmeasurement VALUES(" .
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

    public function getMeasurementByClientId($id) {
        $query = "SELECT * FROM tbmeasurement WHERE idpersonmeasurement='" . $id . "'";
        $measurementResult = $this->exeQuery($query);
        $measurementArray = array();
        while ($row = mysqli_fetch_array($measurementResult)) {
            $array = array("idMeasurement" => $row['idmeasurement'],
                "idPersonMeasurement" => $row['idpersonmeasurement'],
                "measurementDate" => $row['measurementdatemeasurement'],
                "transverseThorax" => $row['transversethoraxmeasurement'],
                "backThorax" => $row['backthoraxmeasurement'],
                "biiliocrestideo" => $row['biiliocrestideomeasurement'],
                "humeral" => $row['humeralmeasurement'],
                "femoral" => $row['femoralmeasurement'],
                "head" => $row['headmeasurement'],
                "armRelaxed" => $row['armrelaxedmeasurement'],
                "armFlexed" => $row['armflexedmeasurement'],
                "forearmMeasurement" => $row['forearmmeasurement'],
                "mesosternalThoraxMeasurement" => $row['mesosternalthoraxmeasurement'],
                "waistMeasurement" => $row['waistmeasurement'],
                "hipMeasurement" => $row['hipmeasurement'],
                "innerThighMeasurement" => $row['innerthighmeasurement'],
                "upperThighMeasurement" => $row['upperthighmeasurement'],
                "calfMaxMeasurement" => $row['calfmaxmeasurement'],
                "tricepsMeasurement" => $row['tricepsmeasurement'],
                "subscapularMeasurement" => $row['subscapularmeasurement'],
                "abdominalMeasurement" => $row['abdominalmeasurement'],
                "medialThighMeasurement" => $row['medialthighmeasurement'],
                "calfMeasurement" => $row['calfmeasurement']
            );
            array_push($measurementArray, $array);
        }
//        var_dump($measurementArray);
//        echo (json_encode($measurementArray));

        return $measurementArray;
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
