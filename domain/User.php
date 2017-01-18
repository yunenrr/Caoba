<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author luisd
 */
class User {

    private $idUser;
    private $idPersonUser;
    private $typeUser; //-- 0 = ROOT -- 1 = ADMIN -- 2 = ADMIN & INSTRUCTOR -- 3 = INSTRUCTOR -- 4 = CLIENT
    private $userNameUser;
    private $passUser;

    function User($idUser, $idPersonUser, $typeUser, $userNameUser, $passUser) {
        $this->idUser = $idUser;
        $this->idPersonUser = $idPersonUser;
        $this->typeUser = $typeUser;
        $this->userNameUser = $userNameUser;
        $this->passUser = $passUser;
    }

    function getIdUser() {
        return $this->idUser;
    }

    function getIdPersonUser() {
        return $this->idPersonUser;
    }

    function getTypeUser() {
        return $this->typeUser;
    }

    function getUserNameUser() {
        return $this->userNameUser;
    }

    function getPassUser() {
        return $this->passUser;
    }

    function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    function setIdPersonUser($idPersonUser) {
        $this->idPersonUser = $idPersonUser;
    }

    function setTypeUser($typeUser) {
        $this->typeUser = $typeUser;
    }

    function setUserNameUser($userNameUser) {
        $this->userNameUser = $userNameUser;
    }

    function setPassUser($passUser) {
        $this->passUser = $passUser;
    }

}
