<?php

include '../data/DietPlanData.php';

/**
 * Description of DietPlanPlanBusiness
 *
 * @author luisd
 */
class DietPlanBusiness {

     private $dietPlanData;

    public function DietPlanBusiness() {
        $this->dietPlanData = new DietPlanData();
    }

    /**
     * Used to insert a new dietPlan
     * @param type $dietPlan
     * @return type
     */
    public function insertDietPlan($dietPlan) {
        return $this->dietPlanData->insertDietPlan($dietPlan);
    }

    /**
     * Update dietPlan data
     * @param type $dietPlan dietPlan to keep data
     * @return type query result
     */
    public function updateDietPlan($dietPlan) {
        return $this->dietPlanData->updateDietPlan($dietPlan);
    }

    /**
     * Used to delete a dietPlan
     * @param type $id pk of the dietPlan to delete
     * @return type
     */
    public function deleteDietPlan($id) {
        return $this->dietPlanData->deleteDietPlan($id);
    }
    /**
     * Use to get the max id num to the dietPlan registration
     * @return type
     */
    public function getMaxId() {
        return $this->dietPlanData->getMaxId();
    }
}
