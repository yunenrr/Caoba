<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DietPlan
 *
 * @author luisd
 */
class DietPlan {

    private $idDietPlan;
    private $idFoodDietPlan;
    private $idDietDietPlan;
    private $dietDayDietPlan;
    private $dietHourDietPlan;

    function DietPlan($idDietPlan, $idFoodDietPlan, $idDietDietPlan, $dietDayDietPlan, $dietHourDietPlan) {
        $this->idDietPlan = $idDietPlan;
        $this->idFoodDietPlan = $idFoodDietPlan;
        $this->idDietDietPlan = $idDietDietPlan;
        $this->dietDayDietPlan = $dietDayDietPlan;
        $this->dietHourDietPlan = $dietHourDietPlan;
    }

    function getIdDietPlan() {
        return $this->idDietPlan;
    }

    function getIdFoodDietPlan() {
        return $this->idFoodDietPlan;
    }

    function getIdDietDietPlan() {
        return $this->idDietDietPlan;
    }

    function getDietDayDietPlan() {
        return $this->dietDayDietPlan;
    }

    function getDietHourDietPlan() {
        return $this->dietHourDietPlan;
    }

    function setIdDietPlan($idDietPlan) {
        $this->idDietPlan = $idDietPlan;
    }

    function setIdFoodDietPlan($idFoodDietPlan) {
        $this->idFoodDietPlan = $idFoodDietPlan;
    }

    function setIdDietDietPlan($idDietDietPlan) {
        $this->idDietDietPlan = $idDietDietPlan;
    }

    function setDietDayDietPlan($dietDayDietPlan) {
        $this->dietDayDietPlan = $dietDayDietPlan;
    }

    function setDietHourDietPlan($dietHourDietPlan) {
        $this->dietHourDietPlan = $dietHourDietPlan;
    }

}
