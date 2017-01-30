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



        $query = "INSERT INTO `TBClientRecord` (`idClientRecord`,
                                                `idPersonUserClientRecord`,
                                                `idServicePaymentModuleClientRecord`,
                                                `idRelationServiceScheduleClientRecord`,
                                                `startDateClientRecord`,
                                                `finalDateClientRecord`) 
                 VALUES
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
        $query = "SELECT idService, nameService FROM TBService";

        $allService = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allService)) {
            $array[] = array("idService" => $row['idService'],
                "nameService" => $row['nameService']);
        }

        return $array;
    }

    /**
     * Use to get the services
     * @return type
     */
    public function getDayService($id) {
        $query = "SELECT TBDay.idDay, TBDay.nameDay FROM TBService INNER JOIN 
                  TBRelationserviceschedule ON 
                  TBRelationserviceschedule.idService = TBService.idService INNER JOIN 
                  TBDayhourservice 
                  ON TBRelationserviceschedule.idDayHourService = TBDayhourservice.idDayHourService INNER JOIN 
                  TBDay 
                  ON TBDayhourservice.dayService = TBDay.idDay WHERE
                  TBService.idService = " . $id . " GROUP BY TBDay.nameDay";

        $allService = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allService)) {
            $array[] = array("idDay" => $row['idDay'],
                "nameDay" => $row['nameDay']);
        }

        return $array;
    }

    /**
     * Use to get the hour start
     * @return type
     */
    public function getHourStartService($id, $idDay) {
        $query = "SELECT TBDayhourservice.idDayHourService, TBHour.idHour FROM TBService INNER JOIN 
                    TBRelationserviceschedule ON 
                    TBRelationserviceschedule.idService = TBService.idService INNER JOIN 
                    TBDayhourservice ON 
                    TBRelationserviceschedule.idDayHourService = TBDayhourservice.idDayHourService INNER JOIN 
                    TBDay ON 
                    TBDayhourservice.dayService = TBDay.idDay INNER JOIN 
                    TBHour ON
                    TBDayhourservice.hourStartService = TBHour.idHour WHERE 
                    TBService.idService = " . $id . " AND TBDay.idDay = " . $idDay;

        $hourStart = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($hourStart)) {
            $array[] = array("idDayHourService" => $row['idDayHourService'],
                "idHour" => $row['idHour']);
        }
        return $array;
    }

    /**
     * Use to get the hour end
     * @return type
     */
    public function getHourEndService($id) {
        $query = "SELECT TBHour.idHour, (TBhour.numberHour + 1) AS HourEnd FROM TBDayhourservice INNER JOIN 
                    TBHour ON TBDayhourservice.hourEndService = TBHour.idHour 
                    WHERE TBDayhourservice.idDayHourService = " . $id;

        $hourStart = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($hourStart)) {
            $array[] = array("idHour" => $row['idHour'],
                "HourEnd" => $row['HourEnd']);
        }
        return $array;
    }

    public function getCampusService($id) {
        $query = "SELECT TBCampus.nameCampus FROM TBService INNER JOIN 
                    TBRelationserviceschedule ON 
                    TBRelationserviceschedule.idService = TBService.idService INNER JOIN 
                    TBDayhourservice ON
                    TBRelationserviceschedule.idRelationServiceSchedule = TBDayhourservice.idDayHourService INNER JOIN 
                    TBCampus ON 
                    TBDayhourservice.idCampusService = TBCampus.idCampus WHERE 
                    TBService.idService = " . $id . " GROUP BY TBCampus.nameCampus";

        $campus = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($campus)) {
            $array[] = array("nameCampus" => $row['nameCampus']);
        }
        return $array;
    }

    public function getInstructorService($id) {
        $query = "SELECT TBPerson.namePerson FROM TBService INNER JOIN
                    TBInstructor ON TBService.idInstructorService = TBInstructor.idInstructor INNER JOIN 
                    TBPerson ON TBInstructor.idPersonInstructor = TBPerson.idPerson WHERE TBService.idService = " . $id;

        $instructor = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($instructor)) {
            $array[] = array("namePerson" => $row['namePerson']);
        }
        return $array;
    }

    public function getPaymentModuleService($id) {
        $query = "SELECT TBPaymentModule.idPaymentModule, TBPaymentModule.namePaymentModule FROM TBPaymentModule "
                . "INNER JOIN TBServicePaymentModule ON TBPaymentModule.idPaymentModule = "
                . "TBServicePaymentModule.idPaymentModuleServicePaymentModule WHERE "
                . "TBServicePaymentModule.idServiceServicePaymentModule = $id;";

        $module = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($module)) {
            $array[] = array("idPaymentModule" => $row['idPaymentModule'],
                "namePaymentModule" => $row['namePaymentModule']);
        }
        return $array;
    }

    public function getIdRelationtServices($idService, $idRelation) {
        $query = "SELECT TBRelationserviceschedule.idRelationServiceSchedule 
                    FROM TBRelationserviceschedule 
                    INNER JOIN tbservice 
                    ON TBRelationserviceschedule.idService = TBService.idService 
                    WHERE TBService.idService = " . $idService . " AND TBRelationserviceschedule.idDayHourService = " . $idRelation . ";";
        
        $getId = $this->exeQuery($query);
        $row = mysqli_fetch_array($getId);

        return $row['idRelationServiceSchedule'];
    }

    public function getIdTbServicePaymentModule($idService, $idModule) {
        $query = "SELECT TBServicePaymentModule.idServicePaymentModule FROM TBServicePaymentModule"
                . " WHERE TBServicePaymentModule.idServiceServicePaymentModule = " . $idService . " AND "
                . "TBServicePaymentModule.idPaymentModuleServicePaymentModule = " . $idModule . ";";
       
        $getId = $this->exeQuery($query);
        $row = mysqli_fetch_array($getId);

        return $row['idServicePaymentModule'];
    }

    /**
     * Use to get the max id num to the ClientRecord
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("ClientRecord");
    }

}
