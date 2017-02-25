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
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);

        if ($array['count'] > 1) {
            return array("msg" => "si");
        } else {
            return $array = array("msg" => "no");
        }
    }

    public function calcMuscleMass($measurement) {
        $muscleMass = $measurement->getWeightMeasurement() / ($measurement->getHeightMeasurement() * $measurement->getHeightMeasurement());
        return $muscleMass;
    }

    public function calcTotalFatMeasurement($mucleMass, $age, $gender) {

        $totalFat = ((1.2 * $mucleMass) + (0.23 * $age) - (10.8 * $gender)) - 5.4;

        return $totalFat;
    }

    public function calcAge($age) {
        date_default_timezone_set("America/Costa_Rica");
        $time = time();
        $date = date("Y", $time);
        $newDate = strtotime($age);
        $dateFormat = date("Y", $newDate);
        return $date - $dateFormat;
    }

    public function insertMeasurement($measurement) {
        $query = "select birthdayperson,genderperson from tbperson where idperson=" . $measurement->getIdPersonMeasurement();
        $result = $this->exeQuery($query);
        $ret = $result->fetch_assoc();
        $age = $this->calcAge($ret['birthdayperson']);
        $gender = $ret['genderperson'];
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
        $mucleMass = $this->calcMuscleMass($measurement);
        $totalFat = $this->calcTotalFatMeasurement($mucleMass, $age, $gender);


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
                $mucleMass . "," .
                $measurement->getWeightMeasurement() . "," .
                $totalFat . "," .
                $measurement->getHeightMeasurement() . ");";
        return $this->exeQuery($query);
    }

    /**
     * Update measurement values
     * @param type $measurement
     * @return type
     */
    public function updateMeasurement($measurement) {
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
                "weight" => $row['weightmeasurement'],
                "totalfat" => $row['totalfatmeasurement'],
                "height" => $row['heightmeasurement']
            );
            array_push($measurementArray, $array);
        }
//        var_dump($measurementArray);
//        echo (json_encode($measurementArray));

        return $measurementArray;
    }

    public function getMeasurementByClientIdForGraph($id) {
        $query = "SELECT musclemassmeasurement,weightmeasurement,totalfatmeasurement,measurementdatemeasurement FROM tbmeasurement WHERE idpersonmeasurement='" . $id . "'";
        $measurementResult = $this->exeQuery($query);
        $muscleMassArray = array();
        $weightArray = array();
        $totalfatArray = array();
        $stringArray = array();
        $array = array();
        $str = "";
        $aux = "";
        $musclemass = "";
        $flat = 0;
        while ($row = mysqli_fetch_array($measurementResult)) {
            array_push($muscleMassArray, $row['musclemassmeasurement']);
            array_push($weightArray, $row['weightmeasurement'] / 2.5);
            array_push($totalfatArray, $row['totalfatmeasurement']);
            if ($flat === 1) {
                if ($musclemass < $row['musclemassmeasurement']) {
                    $aux = "Aumenta";
                } else if ($musclemass === $row['musclemassmeasurement']) {
                    $aux = "Se mantiene";
                } else {
                    $aux = "Reduce";
                }
            }
            
            $str = $str. $row['measurementdatemeasurement']  ."\n-Este mes:\n" . $aux. "\n-Estado actual:\n" . $this->msg($row['musclemassmeasurement'])."\n" ;
            array_push($stringArray, $str);
            $musclemass = $row['musclemassmeasurement'];
            $str = "";
            $flat = 1;
        }





        array_push($array, $stringArray);
        array_push($array, $muscleMassArray);
        array_push($array, $weightArray);
        array_push($array, $totalfatArray);
        return $array;
    }

    public function msg($musclemassmeasurement) {
        if ($musclemassmeasurement < 18) {
            return "Desnutrición";
        } else if ($musclemassmeasurement > 17 && $musclemassmeasurement < 25) {
            return "Normal";
        } else if ($musclemassmeasurement > 24.9 && $musclemassmeasurement < 27) {
            return "Sobrepeso";
        } else if ($musclemassmeasurement > 26.9 && $musclemassmeasurement < 30) {
            return "Obesidad\ngrado 1.";
        } else if ($musclemassmeasurement > 29.9 && $musclemassmeasurement < 40) {
            return "Obesidad \ngrado 2.";
        } else if ($musclemassmeasurement > 39.9) {
            return "Obesidad\n extrema.";
        }
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
