<?php

include '../data/PersonStateData.php';

/**
 * Description of PersonStateBusiness
 *
 * @author luisd
 */
class PersonStateBusiness {

    private $personStateData;

    public function PersonStateBusiness() {
        return $this->personStateData = new PersonStateData();
    }

    /**
     * Used to insert a new personState
     * @param type $personState
     * @return type
     */
    public function insertPersonState($personState) {
        return $this->personStateData->insertPersonState($personState);
    }

    /**
     * Used to insert a new personState
     * @param type $id
     * @return type
     */
    public function getPersonStateBusiness($id) {
        return $this->personStateData->getPersonStateData($id);
    }

    /**
     * Update personState data
     * @param type $personState personState to keep data
     * @return type query result
     */
    public function updatePersonState($personState) {
        return $this->personStateData->updatePersonState($personState);
    }

    /**
     * Used to delete a personState
     * @param type $id pk of the personState to delete
     * @return type
     */
    public function deletePersonState($id) {
        return $this->personStateData->deletePersonState($id);
    }

}
