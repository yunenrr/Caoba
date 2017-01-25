<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/User.php';

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
        $query = "INSERT INTO TBUser(idUser,idPersonUser,TypeUser,userNameUser,passUser)"
                . "VALUES ('" . $user->getIdUser() . "'"
                . ", '" . $user->getIdPersonUser() . "'"
                . ",'" . $user->getTypeUser() . "'"
                . ",'" . $user->getUserNameUser() . "'"
                . ",'" . $user->getPassUser() . "');";
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

    /**
     * Use to get the max id num to the user registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("User");
    }

    /**
     * Use to verify if the user name already exist
     * @param type $userName
     * @return type
     */
    public function verifyUserName($userName) {
        $query = "SELECT count(userNameUser) FROM TBUser WHERE userNameUser=" . $userName;
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        return trim($array[0]);
    }

}
