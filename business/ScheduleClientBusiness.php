<?php

include '../data/ScheduleClientData.php';

/**
 * Description of ScheduleClientBusiness
 *
 * @author luisd
 */
class ScheduleClientBusiness {

    private $scheduleClientData;

    public function ScheduleClientBusiness() {
        return $this->scheduleClientData = new ScheduleClientData();
    }

    public function getSchedule($idClient, $idService) {
        return $this->scheduleClientData->getSchedule($idClient, $idService);
    }

    public function getAllSchedule($idClient) {
        return $this->scheduleClientData->getAllSchedule($idClient);
    }

    public function deleteRecord() {
        return $this->scheduleClientData->deleteRecord();
    }

}
