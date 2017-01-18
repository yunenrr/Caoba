<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Food
 *
 * @author luisd
 */
class Food {

    private $idFood;
    private $nameFood;
    private $nutritionalValueFood;

    function __construct($idFood, $nameFood, $nutritionalValueFood) {
        $this->idFood = $idFood;
        $this->nameFood = $nameFood;
        $this->nutritionalValueFood = $nutritionalValueFood;
    }

    function getIdFood() {
        return $this->idFood;
    }

    function getNameFood() {
        return $this->nameFood;
    }

    function getNutritionalValueFood() {
        return $this->nutritionalValueFood;
    }

    function setIdFood($idFood) {
        $this->idFood = $idFood;
    }

    function setNameFood($nameFood) {
        $this->nameFood = $nameFood;
    }

    function setNutritionalValueFood($nutritionalValueFood) {
        $this->nutritionalValueFood = $nutritionalValueFood;
    }

}
