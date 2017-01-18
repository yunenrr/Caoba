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
        $this->dietData = new DietData();
    }

    /**
     * Used to insert a new diet
     * @param type $diet
     * @return type
     */
    public function insertDiet($diet) {
        $this->dietData->insertDiet($diet);
    }

    /**
     * Update diet data
     * @param type $diet diet to keep data
     * @return type query result
     */
    public function updateDiet($diet) {
        $this->dietData->updateDiet($diet);
    }

    /**
     * Used to delete a diet
     * @param type $id pk of the diet to delete
     * @return type
     */
    public function deleteDiet($id) {
        $this->dietData->deleteDiet($id);
    }

}
