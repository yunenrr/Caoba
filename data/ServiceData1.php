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

    public function insertServiceToClient($idClientRecord, $idPersonUserClientRecord, $idServicePaymentModuleClientRecord, $idRelationServiceScheduleClientRecord, $startDateClientRecord) {



        $query = "insert into `tbclientrecord` (`idclientrecord`,
                                                `idpersonuserclientrecord`,
                                                `idservicepaymentmoduleclientrecord`,
                                                `idrelationservicescheduleclientrecord`,
                                                `startdateclientrecord`,
                                                `finaldateclientrecord`) 
                 values
                 (" . $idClientRecord . ""
                . "," . $idPersonUserClientRecord . ""
                . "," . $idServicePaymentModuleClientRecord . ""
                . "," . $idRelationServiceScheduleClientRecord . ""
                . "," . $startDateClientRecord . ""
                . "," . $startDateClientRecord . ");";

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
        $query = "select tbday.idday, tbday.nameday from tbservice inner join 
                  tbrelationserviceschedule on 
                  tbrelationserviceschedule.idservice = tbservice.idservice inner join 
                  tbdayhourservice 
                  on tbrelationserviceschedule.iddayhourservice = tbdayhourservice.iddayhourservice inner join 
                  tbday 
                  on tbdayhourservice.dayservice = tbday.idday where
                  tbservice.idservice = " . $id . " group by tbday.nameday";

        $allService = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allService)) {
            $array[] = array("idday" => $row['idday'],
                "nameday" => $row['nameday']);
        }

        return $array;
    }

    /**
     * Use to get the hour start
     * @return type
     */
    public function getHourStartService($id, $idDay) {
        $query = "select tbdayhourservice.iddayhourservice, tbhour.idhour from tbservice inner join 
                    tbrelationserviceschedule on 
                    tbrelationserviceschedule.idservice = tbservice.idservice inner join 
                    tbdayhourservice on 
                    tbrelationserviceschedule.iddayhourservice = tbdayhourservice.iddayhourservice inner join 
                    tbday on 
                    tbdayhourservice.dayservice = tbday.idday inner join 
                    tbhour on
                    tbdayhourservice.hourstartservice = tbhour.idhour where 
                    tbservice.idservice = " . $id . " and tbday.idday =" . $idDay;

        $hourStart = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($hourStart)) {
            $array[] = array("iddayhourservice" => $row['iddayhourservice'],
                "idhour" => $row['idhour']);
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
        $query = "select tbcampus.namecampus from tbservice inner join 
                    tbrelationserviceschedule on 
                    tbrelationserviceschedule.idservice = tbservice.idservice inner join 
                    tbdayhourservice on
                    tbrelationserviceschedule.idrelationserviceschedule = tbdayhourservice.iddayhourservice inner join 
                    tbcampus on 
                    tbdayhourservice.idcampusservice = tbcampus.idcampus where 
                    tbservice.idservice = " . $id . " group by tbcampus.namecampus";

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

    public function getPaymentModuleService($id) {
        $query = "select tbpaymentmodule.idpaymentmodule, tbpaymentmodule.namepaymentmodule from tbpaymentmodule "
                . "inner join tbservicepaymentmodule on tbpaymentmodule.idpaymentmodule = "
                . "tbservicepaymentmodule.idpaymentmoduleservicepaymentmodule where "
                . "tbservicepaymentmodule.idserviceservicepaymentmodule = $id;";

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
        return $this->getMaxIdTable("clientrecord");
    }

}
