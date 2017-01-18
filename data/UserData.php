<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/';

/**
 * Description of UserData
 *
 * @author luisd
 */
class UserData extends Connector {
    
     /**
     * Used to insert a new user
     * @param type $user
     * @return type
     */
    public function insertUser($user) {
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update user values
     * @param type $user
     * @return type
     */
    public function updateUser($user) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a user by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteUser($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
