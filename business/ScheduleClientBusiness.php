<?php

include '../data/ScheduleClientData.php';

/**
 * Description of ScheduleClientBusiness
 *
 * @author luisd
 */
class ScheduleClientBusiness {

    private $scheduleClientData;

    public function __construct() {
        return $this->scheduleClientData = new ScheduleClientData();
    }

    public function getScheduleClient($idClient) {
        return $this->scheduleClientData->getScheduleClient($idClient);
    }

    public function getAllSchedule($idClient) {
        return $this->scheduleClientData->getAllSchedule($idClient);
    }

    public function deleteRecord() {
        return $this->scheduleClientData->deleteRecord();
    }

}
