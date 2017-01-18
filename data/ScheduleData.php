<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Schedule.php';

/**
 * Description of ScheduleData
 *
 * @author luisd
 */
class ScheduleData extends Connector {
    
     /**
     * Used to insert a new schedule
     * @param type $schedule
     * @return type
     */
    public function insertSchedule($schedule) {
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update schedule values
     * @param type $schedule
     * @return type
     */
    public function updateSchedule($schedule) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a schedule by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteSchedule($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
