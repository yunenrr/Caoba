<?php

include '../data/DietPersonData.php';
/**
 * Description of DietPersonBussiness
 *
 * @author Karen
 */
class DietPersonBusiness {

    private $dietPersonData;

    public function __construct() {
        return $this->dietPersonData = new DietPersonData();
    }
    
    /**
     * Used to insert a new dietperson
     * @param type $dietPerson
     * @return type
     */
    public function insertDietPerson($dietPerson) {
        return $this->dietPersonData->insertDietPerson($dietPerson);
    }
    
      /**
     * Use to get the max id num to the dietPerson registration
     * @return type
     */
    public function getMaxId() {
        return $this->dietPersonData->getMaxId();
    }
    
}
