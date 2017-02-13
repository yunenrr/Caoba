<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Service.php';

/**
 * Description of ServiceData1
 *
 * @author luisd
 */
class ServiceData1 extends Connector {

    public function insertServiceToClient($idclientschedule, 
            $idpersonclientschedule, 
            $startdateclientschedule, 
            $hourclientschedule, 
            $dayclientschedule, 
            $idservicepaymentmoduleclientschedule, 
            $idserviceclientschedule) {

        $query = "insert into `tbclientschedule` (`idclientschedule`,
                                                `idpersonclientschedule`,
                                                `startdateclientschedule`,
                                                `hourclientschedule`,
                                                `dayclientschedule`,
                                                `idservicepaymentmoduleclientschedule`,
                                                `idserviceclientschedule`) 
                 values
                 (" . $idclientschedule . ""
                . "," . $idpersonclientschedule . ""
                . ",'" . $startdateclientschedule . "'"
                . "," . $hourclientschedule . ""
                . "," . $dayclientschedule . ""
                . "," . $idservicepaymentmoduleclientschedule . ""
                . "," . $idserviceclientschedule . ");";

        return $this->exeQuery($query);
    }

    /**
     * Use to get the services
     * @return type
     */
    public function getAllService() {
        $query = "SELECT idservice, nameservice FROM tbservice";

        $allService = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allService)) {
            $array[] = array("idservice" => $row['idservice'],
                "nameservice" => $row['nameservice']);
        }

        return $array;
    }

    /**
     * Use to get the services
     * @return type
     */
    public function getDayService($id) {
        $query = "SELECT dayscheduleservice FROM tbscheduleservice WHERE idservicescheduleservice = " . $id;

        $allService = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allService)) {
            $array[] = array("dayscheduleservice" => $row['dayscheduleservice']);
        }

        return $array;
    }

    /**
     * Use to get the hour start
     * @return type
     */
    public function getHourStartService($id, $idDay) {
        $query = "SELECT hourscheduleservice FROM tbscheduleservice 
                    WHERE idservicescheduleservice = " . $id . " AND dayscheduleservice = " . $idDay . ";";

        $hourStart = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($hourStart)) {
            $array[] = array("hourscheduleservice" => $row['hourscheduleservice']);
        }
        return $array;
    }

    /**
     * Use to get the hour end
     * @return type
     */
    public function getHourEndService($id) {
        $query = "select tbhour.idhour, (tbhour.numberhour + 1) as hourend from tbdayhourservice inner join 
                    tbhour on tbdayhourservice.hourendservice = tbhour.idhour 
                    where tbdayhourservice.iddayhourservice= " . $id;

        $hourStart = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($hourStart)) {
            $array[] = array("idhour" => $row['idhour'],
                "hourend" => $row['hourend']);
        }
        return $array;
    }

    public function getCampusService($id) {
        $query = "SELECT namecampus FROM tbcampus INNER JOIN tbscheduleservice
                    ON tbcampus.idcampus = tbscheduleservice.idcampuscheduleservice INNER JOIN 
                    tbservice ON tbscheduleservice.idservicescheduleservice = tbservice.idservice 
                    WHERE tbservice.idservice = " . $id . ";";

        $campus = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($campus)) {
            $array[] = array("namecampus" => $row['namecampus']);
        }
        return $array;
    }

    public function getInstructorService($id) {
        $query = "select tbperson.nameperson from tbservice inner join
                    tbinstructor on tbservice.idinstructorservice = tbinstructor.idinstructor inner join 
                    tbperson on tbinstructor.idpersoninstructor = tbperson.idperson where tbservice.idservice =" . $id;

        $instructor = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($instructor)) {
            $array[] = array("nameperson" => $row['nameperson']);
        }
        return $array;
    }

    public function getPaymentModuleService() {
        $query = "SELECT idpaymentmodule, namepaymentmodule FROM gymcaoba.tbpaymentmodule;";

        $module = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($module)) {
            $array[] = array("idpaymentmodule" => $row['idpaymentmodule'],
                "namepaymentmodule" => $row['namepaymentmodule']);
        }
        return $array;
    }

    public function getIdRelationtServices($idService, $idRelation) {
        $query = "select tbrelationserviceschedule.idrelationserviceschedule 
                    from tbrelationserviceschedule 
                    inner join tbservice 
                    on tbrelationserviceschedule.idservice = tbservice.idservice 
                    where tbservice.idservice = " . $idservice . " and tbrelationserviceschedule.iddayhourservice =" . $idService . " AND tbrelationserviceschedule.iddayhourservice = " . $idRelation . ";";

        $getId = $this->exeQuery($query);
        $row = mysqli_fetch_array($getId);

        return $row['idRelationServiceSchedule'];
    }

    public function getIdTbServicePaymentModule($idService, $idModule) {
        $query = "select tbservicepaymentmodule.idservicepaymentmodule from tbservicepaymentmodule"
                . " where tbservicepaymentmodule.idserviceservicepaymentmodule = " . $idservice . " and "
                . "tbservicepaymentmodule.idpaymentmoduleservicepaymentmodule =" . $idModule . ";";

        $getId = $this->exeQuery($query);
        $row = mysqli_fetch_array($getId);

        return $row['idservicepaymentmodule'];
    }

    /**
     * Use to get the max id num to the ClientRecord
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("clientschedule");
    }

}
