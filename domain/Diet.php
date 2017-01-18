<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Diet
 *
 * @author luisd
 */
class Diet {

    private $idDiet;
    private $nameDiet;
    private $descriptionDiet;

    function Diet($idDiet, $nameDiet, $descriptionDiet) {
        $this->idDiet = $idDiet;
        $this->nameDiet = $nameDiet;
        $this->descriptionDiet = $descriptionDiet;
    }

    function getIdDiet() {
        return $this->idDiet;
    }

    function getNameDiet() {
        return $this->nameDiet;
    }

    function getDescriptionDiet() {
        return $this->descriptionDiet;
    }

    function setIdDiet($idDiet) {
        $this->idDiet = $idDiet;
    }

    function setNameDiet($nameDiet) {
        $this->nameDiet = $nameDiet;
    }

    function setDescriptionDiet($descriptionDiet) {
        $this->descriptionDiet = $descriptionDiet;
    }

}
