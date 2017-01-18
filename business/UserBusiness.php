<?php

include '../data/UserData.php';

/**
 * Description of UserBusiness
 *
 * @author luisd
 */
class UserBusiness {

    private $userData;

    public function UserBusiness() {
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

    
}
