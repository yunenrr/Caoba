<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';

/**
 * Description of ScheduleClientData
 *
 * @author luisd
 */
class ScheduleClientData extends Connector {

    public function getSchedule($idClient, $idService) {
        $query = "SELECT dayclientschedule, hourclientschedule, nameservice FROM tbclientschedule 
                    INNER JOIN tbservice ON 
                    tbclientschedule.idserviceclientschedule = tbservice.idservice INNER JOIN
                    tbperson ON tbclientschedule.idpersonclientschedule = tbperson.idperson
                    WHERE tbservice.idservice = " . $idService . " AND tbperson.idperson = " . $idClient . ";";

        $allSchedule = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allSchedule)) {
            $array[] = array("dayclientschedule" => $row['dayclientschedule'],
                "hourclientschedule" => $row['hourclientschedule'],
                "nameservice" => $row['nameservice']);
        }
        return $array;
    }

    public function getAllSchedule($idClient) {
        $query = "SELECT nameservice,descriptionservice,priceservicepaymentmodule "
                . "FROM tbclientschedule INNER JOIN tbservice "
                . "ON  tbclientschedule.idserviceclientschedule = tbservice.idservice "
                . "AND tbclientschedule.idpersonclientschedule =" . $idClient
                . "INNER JOIN tbservicepaymentmodule "
                . "WHERE idserviceservicepaymentmodule = tbservice.idservice";

        $allSchedule = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allSchedule)) {
            $array[] = array("nombre" => $row['nameservice'],
                "descrip" => $row['descriptionservice'],
                "price" => $row['priceservicepaymentmodule']);
        }
        return $array;
    }

    public function getAllServiceClient($id) {
        $query = "SELECT tbclientschedule.idclientschedule, tbservicepaymentmodule.idpaymentmoduleservicepaymentmodule,"
                . " DATEDIFF( tbclientschedule.enddateclientschedule, tbclientschedule.startdateclientschedule ) AS days, "
                . "tbservicepaymentmodule.priceservicepaymentmodule "
                . "FROM tbclientschedule INNER JOIN tbservicepaymentmodule "
                . "where not exists (SELECT idclientschedule "
                . "from tbclientschedule INNER JOIN tbpaymentclient "
                . "where tbclientschedule.idclientschedule = tbpaymentclient.idclientschedulepaymentclient) "
                . "and tbclientschedule.idserviceclientschedule = tbservicepaymentmodule.idserviceservicepaymentmodule "
                . "AND tbclientschedule.idservicepaymentmoduleclientschedule = tbservicepaymentmodule.idservicepaymentmodule "
                . "AND tbclientschedule.idpersonclientschedule=".$id;

        $allSchedule = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allSchedule)) {
            $array[] = array("idclientschedule" => $row['idclientschedule'],
                "paymentmodule" => $row['idpaymentmoduleservicepaymentmodule'],
                "days" => $row['days'],
                "price" => $row['priceservicepaymentmodule']);
        }
        return $array;
    }
    
     public function getInvoice($id) {
        $query = "SELECT tbservice.nameservice, tbservice.descriptionservice, "
                . "tbpaymentclient.paymentpaymentclient, tbpaymentclient.totalpaymentpaymentclient, tbpaymentmoduleclient.idpaymentmodulepaymentsclient "
                . "FROM tbservice INNER JOIN tbclientschedule ON tbclientschedule.idserviceclientschedule= "
                . "tbservice.idservice INNER JOIN tbpaymentclient ON  "
                . "tbpaymentclient.idclientschedulepaymentclient =tbclientschedule.idclientschedule "
                . "INNER JOIN tbpaymentmoduleclient ON idpersonpaymentsclient =".$id;

        $allSchedule = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allSchedule)) {
            $array[] = array("name" => $row['nameservice'],
                "descrip" => $row['descriptionservice'],
                "abono" => $row['paymentpaymentclient'],
                "type" => $row['idpaymentmodulepaymentsclient'],
                "total" => $row['totalpaymentpaymentclient']);
        }
        return $array;
    }

    function deleteRecord() {
        $query = 'DELETE FROM `tbclientschedule` WHERE (DATEDIFF(enddateclientschedule,NOW())) < 0;';
        return $this->exeQuery($query);
    }
    function updateInvoice($id){
        $query="UPDATE tbpaymentclient, tbpaymentModuleclient SET totalpaymentpaymentclient=totalpaymentpaymentclient-paymentpaymentclient "
                . "WHERE idpaymentmodulepaymentclient= idpaymentmoduleclient AND  idpersonpaymentsclient =".$id;
        return $this->exeQuery($query);
    }

}
