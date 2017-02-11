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
        $query = "insert into tbuser(iduser,idpersonuser,typeuser,usernameuser,passuser,startdateuser)"
                . "values ('" . $user->getIdUser() . "'"
                . ", '" . $user->getIdPersonUser() . "'"
                . ",'" . $user->getTypeUser() . "'"
                . ",'" . $user->getUserNameUser() . "'"
                . ",'" . $user->getPassUser() . "'"
                . ",'" . $user->getStarDate(). "');";
        if ($user->getTypeUser() == 1 || $user->getTypeUser() == 2) {
            if ($this->exeQuery($query)) {
                $idInstructor = $this->getMaxIdTable("instructor");
                $sql = "INSERT INTO `gymcaoba`.`tbinstructor` (`idinstructor`, `idpersoninstructor`)"
                        . "values ('" .$idInstructor. "'"
                        . ",'" . $user->getIdPersonUser() . "');";
                return $this->exeQuery($sql);
            }
        } else {
            return $this->exeQuery($query);
        }
    }

    /**
     * Update user values
     * @param type $user
     * @return type
     */
    public function updateUser($user) {

        $query = "UPDATE TBUser SET "
                . "userNameUser = '" . $user->getUserNameUser() . "'"
                . ", passUser = '" . $user->getPassUser() . "'"
                . " WHERE idPersonUser = '" . $user->getIdPersonUser() . "'";

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
        return $this->getMaxIdTable("user");
    }

    /**
     * Use to verify if the user name already exist
     * @param type $userName
     * @return type
     */
    public function verifyUserName($userName, $pass) {
        $query = "select count(usernameuser) from tbuser where usernameuser = '" . $userName . "' and passuser = '" . $pass."'";
        $result = $this->exeQuery($query);
        $row = mysqli_fetch_array($result);
        
        return $row[0];
    }

    /**
     * Use to get a specif user
     * @param type $idPersonUser
     * @return \User
     */
    public function getUser($userName, $pass) {

        $query = "select * from tbuser where usernameuser='" . $userName. "' and passuser = '". $pass."'";
        $userResult = $this->exeQuery($query);
        
        $row = mysqli_fetch_array($userResult);
        $user = new User($row['iduser'], $row['idpersonuser'], $row['typeuser'], $row['usernameuser'], $row['passuser'],0);

        return $user;
    }

    /**
     * Use to get a specif user
     * @param type $idPerson
     * @return \User
     */
    public function getUserByIdPerson($idPerson) {

        $query = "select iduser,idpersonuser,typeuser,usernameuser,passuser from tbuser where idpersonuser='" . $idPerson. "'";
        $userResult = $this->exeQuery($query);
        
        $row = mysqli_fetch_array($userResult);
        $user = new User($row['iduser'], $row['idpersonuser'], $row['typeuser'], $row['usernameuser'], $row['passuser'],0);

        return $user;
    }

}
