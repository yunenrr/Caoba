<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/DietPlanPlan.php';

/**
 * Description of DietPlanPlanData
 *
 * @author luisd
 */
class DietPlanPlanData extends Connector {

    /**
     * Used to insert a new dietPlan
     * @param type $dietPlan
     * @return type
     */
    public function insertDietPlan($dietPlan) {
        $query = "";

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

}
