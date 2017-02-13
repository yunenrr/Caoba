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
    private $typeUser;
    private $userNameUser;
    private $passUser;
    private $starDate;

    function User($idUser, $idPersonUser, $typeUser, $userNameUser, $passUser, $starDate) {
        $this->idUser = $idUser;
        $this->idPersonUser = $idPersonUser;
        $this->typeUser = $typeUser;
        $this->userNameUser = $userNameUser;
        $this->passUser = $passUser;
        $this->starDate = $starDate;
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

    function getStarDate() {
        return $this->starDate;
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

    function setStarDate($starDate) {
        $this->starDate = $starDate;
    }

}
