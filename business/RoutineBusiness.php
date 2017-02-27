<?php

include '../data/RoutineData.php';

/**
 * Description of RoutineBusiness
 *
 * @author luisd
 */
class RoutineBusiness {

    private $routineData;

    public function __construct() {
        return $this->routineData = new RoutineData();
    }

    /**
     * Used to insert a new routine
     * @param type $routine
     * @return type
     */
    public function insertRoutine($routine) {
        return $this->routineData->insertRoutine($routine);
    }

    /**
     * Update routine data
     * @param type $routine routine to keep data
     * @return type query result
     */
    public function updateRoutine($routine) {
        return $this->routineData->updateRoutine($routine);
    }

    /**
     * Used to delete a routine
     * @param type $id pk of the routine to delete
     * @return type
     */
    public function deleteRoutine($id) {
        return $this->routineData->deleteRoutine($id);
    }
    
    /**
     * Use to get the routine of the person
     * @return type
     */
    public function getAllRoutine($idPerson){
        return $this->routineData->getAllRoutine($idPerson);
    }


    /**
     * Use to get the max id num to the people registration
     * @return type
     */
    public function getMaxId() {
        return $this->routineData->getMaxId();
    }

}
