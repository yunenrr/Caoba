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

    public function insertServiceToClient($idclientschedule, $idpersonclientschedule, $startdateclientschedule, $enddateclientschedule, $hourclientschedule, $dayclientschedule, $idservicepaymentmoduleclientschedule, $idserviceclientschedule) {

        $this->delete($dayclientschedule, $hourclientschedule);

        $query = "insert into `tbclientschedule` (`idclientschedule`,
                                                `idpersonclientschedule`,
                                                `startdateclientschedule`,
                                                `enddateclientschedule`,
                                                `hourclientschedule`,
                                                `dayclientschedule`,
                                                `idservicepaymentmoduleclientschedule`,
                                                `idserviceclientschedule`) 
                 values
                 (" . $idclientschedule . ""
                . "," . $idpersonclientschedule . ""
                . ",'" . $startdateclientschedule . "'"
                . ",'" . $enddateclientschedule . "'"
                . "," . $hourclientschedule . ""
                . "," . $dayclientschedule . ""
                . "," . $idservicepaymentmoduleclientschedule . ""
                . "," . $idserviceclientschedule . ");";
        
        

        if ($this->exeQuery($query)) {
            $query2 = 'UPDATE `tbservice` SET `quotaservice`= (`quotaservice` - 1) WHERE  `idservice`= ' . $idserviceclientschedule;
            if ($this->exeQuery($query2)) {
                return true;
            }
        }
        return false;
    }

    public function delete($day, $hour) {
        $query = "SELECT idclientschedule FROM tbclientschedule WHERE hourclientschedule = " . $hour . " AND dayclientschedule = " . $day . ";";
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        $id = trim($array[0]);

        $query2 = "SELECT idserviceclientschedule FROM tbclientschedule WHERE hourclientschedule = " . $hour . " AND dayclientschedule = " . $day . ";";
        $result1 = $this->exeQuery($query2);
        $array1 = mysqli_fetch_array($result1);
        $idService = trim($array1[0]);

        $query3 = "DELETE FROM tbclientschedule WHERE idclientschedule = " . $id . "; ";
        $this->exeQuery($query3);

        $query4 = "UPDATE tbservice SET quotaservice = quotaservice + 1 WHERE idservice = " . $idService . ";";
        $this->exeQuery($query4);
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
        $query = "SELECT dayscheduleservice FROM tbscheduleservice WHERE idservicescheduleservice = " . $id . " GROUP BY dayscheduleservice";

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
        $query = "SELECT hourscheduleservice FROM tbscheduleservice "
                . "WHERE idservicescheduleservice = " . $id . " "
                . "AND dayscheduleservice = " . $idDay . " GROUP BY hourscheduleservice;";

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
where tbdayhourservice.iddayhourservice = " . $id;

        $hourStart = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($hourStart)) {
            $array[] = array("idhour" => $row['idhour'],
                "hourend" => $row['hourend']);
        }
        return $array;
    }

    public function getCampusService($id) {
        $query = "SELECT idcampus, namecampus, quotaservice FROM tbcampus INNER JOIN tbscheduleservice
ON tbcampus.idcampus = tbscheduleservice.idcampuscheduleservice INNER JOIN
tbservice ON tbscheduleservice.idservicescheduleservice = tbservice.idservice
WHERE tbservice.idservice = " . $id . " GROUP BY idcampus;
";

        $campus = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($campus)) {
            $array[] = array("idcampus" => $row['idcampus'],
                "quotaservice" => $row['quotaservice'],
                "namecampus" => $row['namecampus']);
        }
        return $array;
    }

    public function getCampus() {
        $query = "SELECT idcampus, namecampus FROM tbcampus";

        $campus = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($campus)) {
            $array[] = array("idcampus" => $row['idcampus'],
                "namecampus" => $row['namecampus']);
        }
        return $array;
    }

    public function getInstructorService($id) {
        $query = "select tbperson.nameperson from tbservice inner join
tbinstructor on tbservice.idinstructorservice = tbinstructor.idinstructor inner join
tbperson on tbinstructor.idpersoninstructor = tbperson.idperson where tbservice.idservice = " . $id;

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
where tbservice.idservice = " . $idservice . " and tbrelationserviceschedule.iddayhourservice = " . $idService . " AND tbrelationserviceschedule.iddayhourservice = " . $idRelation . ";
";

        $getId = $this->exeQuery($query);
        $row = mysqli_fetch_array($getId);

        return $row['idRelationServiceSchedule'];
    }

    public function getIdTbServicePaymentModule($idService, $idModule) {
        $query = "select tbservicepaymentmodule.idservicepaymentmodule from tbservicepaymentmodule"
                . " where tbservicepaymentmodule.idserviceservicepaymentmodule = " . $idservice . " and "
                . "tbservicepaymentmodule.idpaymentmoduleservicepaymentmodule = " . $idModule . ";
";

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

    public function getQuota($id) {
        $query = 'SELECT quotaservice FROM gymcaoba.tbservice where idservice = ' . $id;
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        $quota = trim($array[0]);
        return $quota;
    }

    public function getScheduleCampus($id) {
        $query = "SELECT idservicescheduleservice, dayscheduleservice, hourscheduleservice, nameservice, quotaservice FROM tbscheduleservice
INNER JOIN tbservice ON
tbscheduleservice.idservicescheduleservice = tbservice.idservice
WHERE tbscheduleservice.idcampuscheduleservice = " . $id . ";
";

        $allSchedule = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allSchedule)) {
            $array[] = array("idservicescheduleservice" => $row['idservicescheduleservice'],
                "dayscheduleservice" => $row['dayscheduleservice'],
                "quotaservice" => $row['quotaservice'],
                "hourscheduleservice" => $row['hourscheduleservice'],
                "nameservice" => $row['nameservice']);
        }
        return $array;
    }

    public function getScheduleService($idService, $idCampus) {
        $query = "SELECT dayscheduleservice, hourscheduleservice, nameservice, quotaservice FROM tbscheduleservice
INNER JOIN tbservice ON
tbscheduleservice.idservicescheduleservice = tbservice.idservice
WHERE tbscheduleservice.idcampuscheduleservice = " . $idCampus . "
AND tbscheduleservice.idservicescheduleservice = " . $idService . ";
";

        $allSchedule = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allSchedule)) {
            $array[] = array("dayscheduleservice" => $row['dayscheduleservice'],
                "hourscheduleservice" => $row['hourscheduleservice'],
                "quotaservice" => $row['quotaservice'],
                "nameservice" => $row['nameservice']);
        }
        return $array;
    }

}
