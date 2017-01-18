<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Diet.php';

/**
 * Se hace herencia de la clase "Connector", para poder realizar 
 *
 * @author luisd
 */
class DietData extends Connector {

    /**
     * Used to insert a new diet
     * @param type $diet
     * @return type
     */
    public function insertDiet($diet) {
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update diet values
     * @param type $diet
     * @return type
     */
    public function updateDiet($diet) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a diet by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteDiet($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
