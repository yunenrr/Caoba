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
    public function returnMeasurementQuantity($id) {
        $query = "select count(*) as count from tbmeasurement where idpersonmeasurement=" . $id;
//        echo  $query;
//        exit;

        $result = $this->exeQuery($query);

        $array = mysqli_fetch_array($result);
//        var_dump($array);
//        exit;
//        
        if ($array['count'] > 1) {
            return array("msg" => "si");
        } else {
            return $array = array("msg" => "no");
        }
//        return $this->exeQuery($query);
    }

    public function calcMuscleMass($measurement) {
        return rand(1,3)+ $this->randomAlpha();
    }

    public function calcMetabolicAge($measurement) {
        return rand(1, 3)+ $this->randomAlpha();
    }

    public function calcTotalFatMeasurement($measurement) {
        return rand(1, 3)+ $this->randomAlpha();
    }

    public function randomAlpha() {
//        srand(time());
        $rnd = rand(0, 100);
        return $rnd / 100;
    }

    public function insertMeasurement($measurement) {
        $query = "select max(measurementdatemeasurement) as measurementdatemeasurement from tbmeasurement where idpersonmeasurement=" . $measurement->getIdPersonMeasurement();
        $result = $this->exeQuery($query);
        $ret = $result->fetch_assoc();
        if ($ret['measurementdatemeasurement'] == null) {
            date_default_timezone_set("America/Costa_Rica");
            $time = time();
            $date = date("Y-m-d ", $time) . "";
        } else {
            $nuevafecha = strtotime('+1 month', strtotime($ret['measurementdatemeasurement']));
            $date = date("Y-m-d", $nuevafecha);
        }


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
                $measurement->getCalfMeasurement() . "," .
                $this->calcMuscleMass($measurement)  . "," .
                $this->calcMetabolicAge($measurement) . "," .
                $this->calcTotalFatMeasurement($measurement) .
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
                "forearm" => $row['forearmmeasurement'],
                "mesosternalThorax" => $row['mesosternalthoraxmeasurement'],
                "waist" => $row['waistmeasurement'],
                "hip" => $row['hipmeasurement'],
                "innerThigh" => $row['innerthighmeasurement'],
                "upperThigh" => $row['upperthighmeasurement'],
                "calfMax" => $row['calfmaxmeasurement'],
                "triceps" => $row['tricepsmeasurement'],
                "subscapular" => $row['subscapularmeasurement'],
                "supraspiral" => $row['supraspiralmeasurement'],
                "abdominal" => $row['abdominalmeasurement'],
                "medialThigh" => $row['medialthighmeasurement'],
                "calf" => $row['calfmeasurement'],
                "musclemass" => $row['musclemassmeasurement'],
                "metabolicage" => $row['metabolicagemeasurement'],
                "totalfat" => $row['totalfatmeasurement']
            );
            array_push($measurementArray, $array);
        }
//        var_dump($measurementArray);
//        echo (json_encode($measurementArray));

        return $measurementArray;
    }

    public function getMeasurementByClientIdForGraph($id) {
        $query = "SELECT musclemassmeasurement,metabolicagemeasurement,totalfatmeasurement,measurementdatemeasurement FROM tbmeasurement WHERE idpersonmeasurement='" . $id . "'";
        $measurementResult = $this->exeQuery($query);
        $muscleMassArray = array();
        $metabolicAgeArray = array();
        $totalfatArray = array();
        $dateArray = array();
        $array = array();
        while ($row = mysqli_fetch_array($measurementResult)) {
            array_push($muscleMassArray, $row['musclemassmeasurement']);
            array_push($metabolicAgeArray, $row['metabolicagemeasurement']);
            array_push($totalfatArray, $row['totalfatmeasurement']);
            array_push($dateArray, $row['measurementdatemeasurement']);
        }
        array_push($array, $dateArray);
        array_push($array, $muscleMassArray);
        array_push($array, $metabolicAgeArray);
        array_push($array, $totalfatArray);
        return $array;
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
