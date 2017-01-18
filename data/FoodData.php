<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Food.php';

/**
 * Description of FoodData
 *
 * @author luisd
 */
class FoodData extends Connector {
   
     /**
     * Used to insert a new food
     * @param type $food
     * @return type
     */
    public function insertFood($food) {
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update food values
     * @param type $food
     * @return type
     */
    public function updateFood($food) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a food by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteFood($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
