<?php

include '../data/DietData.php';

/**
 * Description of DietBusiness
 *
 * @author luisd
 */
class DietBusiness {

    private $dietData;

    public function DietBusiness() {
        return $this->dietData = new DietData();
    }

    /**
     * Used to insert a new diet
     * @param type $diet
     * @return type
     */
    public function insertDiet($diet) {
        return $this->dietData->insertDiet($diet);
    }

    /**
     * Update diet data
     * @param type $diet diet to keep data
     * @return type query result
     */
    public function updateDiet($diet) {
        return $this->dietData->updateDiet($diet);
    }

    /**
     * Used to delete a diet
     * @param type $id pk of the diet to delete
     * @return type
     */
    public function deleteDiet($id) {
        return $this->dietData->deleteDiet($id);
    }

    /**
     * Use to get the max id num to the diet registration
     * @return type
     */
    public function getMaxId() {
        return $this->dietData->getMaxId();
    }
    
    /**
     * use to get a specif diet
     * @param type $idPerson
     * @return type
     */
    public function getDiet($idPerson) {
        return $this->dietData->getDiet($idPerson);
    }

}
