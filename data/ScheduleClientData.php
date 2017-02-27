<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';

/**
 * Description of ScheduleClientData
 *
 * @author luisd
 */
class ScheduleClientData extends Connector {

    public function getScheduleClient($idClient) {
        $query = "SELECT dayclientschedule, hourclientschedule, startdateclientschedule, nameservice  FROM tbclientschedule 
                    INNER JOIN tbservice ON 
                    tbclientschedule.idserviceclientschedule = tbservice.idservice INNER JOIN
                    tbperson ON tbclientschedule.idpersonclientschedule = tbperson.idperson
                    WHERE tbperson.idperson = " . $idClient . ";";
        
        $allSchedule = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allSchedule)) {
            $array[] = array("dayclientschedule" => $row['dayclientschedule'],
                "hourclientschedule" => $row['hourclientschedule'],
                "startdateclientschedule" => $row['startdateclientschedule'],
                "nameservice" => $row['nameservice']);
        }
        return $array;
    }
    
    public function getAllSchedule($idClient) {
        $query = "SELECT dayclientschedule, hourclientschedule, nameservice FROM tbclientschedule 
                    INNER JOIN tbservice ON 
                    tbclientschedule.idserviceclientschedule = tbservice.idservice 
                    WHERE tbclientschedule.idpersonclientschedule = " . $idClient . ";";

        $allSchedule = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allSchedule)) {
            $array[] = array("dayclientschedule" => $row['dayclientschedule'],
                "hourclientschedule" => $row['hourclientschedule'],
                "nameservice" => $row['nameservice']);
        }
        return $array;
    }

    function deleteRecord() {
        $query = 'DELETE FROM `tbclientschedule` WHERE (DATEDIFF(enddateclientschedule,NOW())) < 0;';
        $this->exeQuery($query);
    }
}
