<?php

include '../data/ScheduleData.php';

/**
 * Description of ScheduleBusiness
 *
 * @author luisd
 */
class ScheduleBusiness {

    private $scheduleData;

    public function ScheduleBusiness() {
        return $this->scheduleData = new ScheduleData();
    }

    /**
     * Used to insert a new schedule
     * @param type $schedule
     * @return type
     */
    public function insertSchedule($schedule) {
        return $this->scheduleData->insertSchedule($schedule);
    }

    /**
     * Update schedule data
     * @param type $schedule schedule to keep data
     * @return type query result
     */
    public function updateSchedule($schedule) {
        return $this->scheduleData->updateSchedule($schedule);
    }

    /**
     * Used to delete a schedule
     * @param type $id pk of the schedule to delete
     * @return type
     */
    public function deleteSchedule($id) {
        return $this->scheduleData->deleteSchedule($id);
    }

}
