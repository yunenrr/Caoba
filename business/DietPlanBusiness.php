<?php

include '../data/DietPlanPlanData.php';

/**
 * Description of DietPlanPlanBusiness
 *
 * @author luisd
 */
class DietPlanPlanBusiness {

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
        $this->dietPlanData->insertDietPlan($dietPlan);
    }

    /**
     * Update dietPlan data
     * @param type $dietPlan dietPlan to keep data
     * @return type query result
     */
    public function updateDietPlan($dietPlan) {
        $this->dietPlanData->updateDietPlan($dietPlan);
    }

    /**
     * Used to delete a dietPlan
     * @param type $id pk of the dietPlan to delete
     * @return type
     */
    public function deleteDietPlan($id) {
        $this->dietPlanData->deleteDietPlan($id);
    }
}
