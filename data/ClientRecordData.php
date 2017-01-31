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
            $dateSecuence = $this->calculateDate($date, $row['namepaymentModule']);
            $array = array(
                "idserviceservicepaymentmodule" => $row['idserviceservicepaymentModule'],
                "nameservice" => $row['nameservice'],
                "namepaymentModule" => $row['namepaymentModule'],
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

    function calculateDate($fechaInicioServicio, $namePaymentModule) {
        date_default_timezone_set("America/Costa_Rica"); // cr date
        $time = time(); // time
        $day = date("d", $time) - 1; //dia de hoy menos 1

        $date = date("Y-m-d", $time); // fecha de hoy

        $primerDiaMes = strtotime('-' . $day . ' day', strtotime($date)); // resto hoy menos uno
        $primero = date("Y-m-d", $primerDiaMes); // obtengo primer dia de este mes

        $month = date("m", $time) . ""; // mes actual
        $year = date("y", $time) . ""; //ano actual
        $first_of_month = mktime(0, 0, 0, $month, 1, $year); // numero  dias
        $maxdays = date('t', $first_of_month) - 1; // cantida de dias del mes menos uno

        $ulDiaMes = strtotime('+' . $maxdays . ' day', strtotime($primero)); // a primeo le sumo 
        $ultimo = date("Y-m-d", $ulDiaMes); // ultimo dia del mes

        $fechats = strtotime($date); //para numeor de dia
        date('w', $fechats); // numero de dia de hoy 0 domingo

        $fechaIngreso = $fechaInicioServicio;

        if ($namePaymentModule == "Daily") {
            $count = 1;
//            echo "diario<br/>";
        } else if ($namePaymentModule == "Weekly") {
            $count = 1;
//            echo "semanal<br/>";
        } else if ($namePaymentModule == "Biweekly") {
            $count = 2;
//            echo "bisemanal<br/>";
        } else if ($namePaymentModule == "Monthly") {
            $count = 4;
//            echo "mensual<br/>";
        } else if ($namePaymentModule == "Session") {
            $count = 5;
//            echo "sesion<br/>";
        }
        $countTemp = 0;
        $array = array();
        while (strtotime($fechaIngreso) <= strtotime($ultimo)):
            $countTemp = $countTemp + 1;
            if ($fechaIngreso >= $primero):
//                echo $fechaIngreso . "<br/>";
                $aux = date("d", strtotime($fechaIngreso));
//                echo intval($aux);
                array_push($array, intval($aux));
            endif;
            if ($count == $countTemp):
//                echo "sale" . "<br/>";
                break;
            endif;
            $fechaIngreso = strtotime('+7 day', strtotime($fechaIngreso));
            $fechaIngreso = date("Y-m-d", $fechaIngreso);
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
