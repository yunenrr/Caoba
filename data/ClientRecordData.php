<?php

require_once '../data/Connector.php';
include '../domain/ClientRecord.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientRecordData
 *
 * @author Edwin
 */
class ClientRecordData extends Connector {

    /**
     * Método para 
     * @param 
     * @return 
     * @autor Edwin Navarro B.
     */
    public function updateClientRecord($clientRecord) {
        return $this->exeQuery($query);
    }

    /**
     * Método para 
     * @param 
     * @return 
     * @autor Edwin Navarro B.
     */
    public function insertClientRecord($clientRecord) {
        $query = "insert into tbclientrecord values(" . $clientRecord->getIdClientRecord()
                . "," . getDniPersonClientRecord() . ","
                . getIdServicePaymentModuleClientRecord() . "," .
                getIdRelationServiceScheduleClientRecord() . ");";
        return $this->exeQuery($query);
    }

    /**
     * Método para.
     * @param 
     * @return 
     * @autor Edwin Navarro B.
     */
    public function returnsRegisteredServices($id) {
        $query = "select idserviceservicepaymentmodule,nameservice,namepaymentmodule,dayservice,hourstartservice,hourendservice "
                . "from tbpaymentmodule inner join tbservicepaymentmodule on idpaymentmodule = idpaymentmoduleservicepaymentmodule "
                . "inner join tbservice on idserviceservicepaymentmodule=tbservice.idservice "
                . "inner join tbrelationserviceschedule on tbservice.idservice=tbrelationserviceschedule.idservice "
                . "inner join tbdayhourservice on tbrelationserviceschedule.iddayhourservice = tbdayhourservice.iddayhourservice"
                . " where idservicepaymentmodule in( select idservicepaymentmoduleclientrecord from tbservicepaymentmodule "
                . "inner join tbclientrecord on idservicepaymentmodule = idservicepaymentmoduleclientrecord where idpersonuserclientrecord ='123')";
        $clientRecordResult = $this->exeQuery($query);
        $clientRecordArray = array();
        while ($row = mysqli_fetch_array($clientRecordResult)) {
            $date = $this->dateOfEntryIntoService($row['idserviceservicepaymentmodule']);
            $dateSecuence = $this->calculateDate($date, $row['namepaymentmodule']);
            $array = array(
                "idserviceservicepaymentmodule" => $row['idserviceservicepaymentmodule'],
                "nameservice" => $row['nameservice'],
                "namepaymentModule" => $row['namepaymentmodule'],
                "dayservice" => $row['dayservice'],
                "hourstartservice" => $row['hourstartservice'],
                "hourendservice" => $row['hourendservice'],
                "days" => $dateSecuence,
            );
            array_push($clientRecordArray, $array);
        }
        return $clientRecordArray;
    }

    public function dateOfEntryIntoService($idservice) {
        $query = "select idservicepaymentmoduleclientrecord,startdateclientrecord "
                . "from tbpaymentmodule inner join tbservicepaymentmodule "
                . "on idpaymentmodule=idpaymentmoduleservicepaymentmodule "
                . "inner join tbclientrecord on idservicepaymentmodule = idservicepaymentmoduleclientrecord "
                . "where idpersonuserclientrecord ='123' and idservicepaymentmoduleclientrecord=
" . $idservice . "";
        $clientRecordResult = $this->exeQuery($query);
        $row = mysqli_fetch_array($clientRecordResult);
        return $row['startdateclientrecord'];
    }

    function calculateDate($dateEndIntoService, $namePaymentModule) {
        date_default_timezone_set("America/Costa_Rica"); // cr date
        $time = time(); // time
        $day = date("d", $time) - 1; //dia de hoy menos 1

        $date = date("Y-m-d", $time); // fecha de hoy

        $fisrtDayTemp = strtotime('-' . $day . ' day', strtotime($date)); // resto hoy menos uno
        $firstDay = date("Y-m-d", $fisrtDayTemp); // obtengo primer dia de este mes

        $month = date("m", $time) . ""; // mes actual
        $year = date("y", $time) . ""; //ano actual
        $first_of_month = mktime(0, 0, 0, $month, 1, $year); // numero  dias
        $maxdays = date('t', $first_of_month) - 1; // cantida de dias del mes menos uno

        $lastDayTemp = strtotime('+' . $maxdays . ' day', strtotime($firstDay)); // a primeo le sumo 
        $lastDay = date("Y-m-d", $lastDayTemp); // ultimo dia del mes

        $fechats = strtotime($date); //para numeor de dia
        date('w', $fechats); // numero de dia de hoy 0 domingo
        $dateEnd = $dateEndIntoService;
        if ($namePaymentModule == "daily") {
            $count = 1;
        } else if ($namePaymentModule == "weekly") {
            $count = 1;
        } else if ($namePaymentModule == "biweekly") {
            $count = 2;
        } else if ($namePaymentModule == "monthly") {
            $count = 4;
        } else if ($namePaymentModule == "session") {
            $count = 5;
        }
        $countTemp = 0;
        $array = array();
        while (strtotime($dateEnd) <= strtotime($lastDay)):
            $countTemp = $countTemp + 1;
            if ($dateEnd >= $firstDay):
                $aux = date("d", strtotime($dateEnd));
                array_push($array, intval($aux));
            endif;
            if ($count == $countTemp):
                break;
            endif;
            $dateEnd = strtotime('+7 day', strtotime($dateEnd));
            $dateEnd = date("Y-m-d", $dateEnd);
        endwhile;
        return $array;
    }

    /**
     * Método para 
     * @param 
     * @return 
     * @autor Edwin Navarro B.
     */
    public function deleteClientRecord($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
