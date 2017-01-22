<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/DietPlan.php';

/**
 * Description of DietPlanPlanData
 *
 * @author luisd
 */
class DietPlanData extends Connector {

    /**
     * Used to insert a new dietPlan
     * @param type $dietPlan
     * @return type
     */
    public function insertDietPlan($dietPlan) {
        $query = "INSERT INTO TBDietPlan(idDietPlan,idFoodDietPlan,idDietDietPlan, dietDayDietPlan,dietHourDietPlan)"
                . "VALUES ('" . $dietPlan->getIdDietPlan() . "'"
                . ",'" . $dietPlan->getIdFoodDietPlan() . "'"
                . ",'" . $dietPlan->getIdDietDietPlan() . "'"
                . ",'" . $dietPlan->getDietDayDietPlan() . "'"
                . ",'" . $dietPlan->getDietHourDietPlan() ."');";

        return $this->exeQuery($query);
    }

    /**
     * Update dietPlan values
     * @param type $dietPlan
     * @return type
     */
    public function updateDietPlan($dietPlan) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a dietPlan by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteDietPlan($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
/**
     * Use to get the max id num to the dietPlan registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("DietPlan");
    }
}
