<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DietPerson
 *
 * @author Karen
 */
class DietPerson {

    private $idDietPerson;
    private $idPersonDietPerson;
    private $idDietDietPerson;

    function DietPerson($idDietPerson, $idPersonDietPerson, $idDietDietPerson) {
        $this->idDietPerson = $idDietPerson;
        $this->idPersonDietPerson = $idPersonDietPerson;
        $this->idDietDietPerson = $idDietDietPerson;
    }

    function getIdDietPerson() {
        return $this->idDietPerson;
    }

    function getIdPersonDietPerson() {
        return $this->idPersonDietPerson;
    }

    function getIdDietDietPerson() {
        return $this->idDietDietPerson;
    }

    function setIdDietPerson($idDietPerson) {
        $this->idDietPerson = $idDietPerson;
    }

    function setIdPersonDietPerson($idPersonDietPerson) {
        $this->idPersonDietPerson = $idPersonDietPerson;
    }

    function setIdDietDietPerson($idDietDietPerson) {
        $this->idDietDietPerson = $idDietDietPerson;
    }

}
