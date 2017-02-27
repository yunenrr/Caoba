<?php

include '../data/UserData.php';

/**
 * Description of UserBusiness
 *
 * @author luisd
 */
class UserBusiness {

    private $userData;

    public function __construct() {
        return $this->userData = new UserData();
    }

    /**
     * Used to insert a new user
     * @param type $user
     * @return type
     */
    public function insertUser($user) {
        return $this->userData->insertUser($user);
    }

    /**
     * Update user data
     * @param type $user user to keep data
     * @return type query result
     */
    public function updateUser($user) {
        return $this->userData->updateUser($user);
    }

    /**
     * Used to delete a user
     * @param type $id pk of the user to delete
     * @return type
     */
    public function deleteUser($id) {
        return $this->userData->deleteUser($id);
    }

    /**
     * Use to get the max id num to the user registration
     * @return type
     */
    public function getMaxId() {
        return $this->userData->getMaxId();
    }

    /**
     * Use to verify if the username already exist
     * @param type $userName
     * @return type
     */
    public function verifyUserNameUser($userName, $pass) {
        return $this->userData->verifyUserName($userName, $pass);
    }
    /**
     * Use to verify if the username already exist
     * @param type $userName
     * @return type
     */
    public function valideUserName($userName){
        return $this->userData->valideUserName($userName);
    }
    /**
     * use to get a specif user
     * @param type $idPersonUser
     * @return type
     */
    public function getUser($userName, $pass) {
        return $this->userData->getUser($userName, $pass);
    }
    /**
     * use to get a specif user
     * @param type $idPerson
     * @return type
     */
    public function getUserByIdPerson($idPerson) {
        return $this->userData->getUserByIdPerson($idPerson);
    }
     /**
     * Use to get a specific password
     * @param type $userName
     * @return type
     */
    public function getPassword($userName){
        return $this->userData->getPassword($userName);
    }

}
