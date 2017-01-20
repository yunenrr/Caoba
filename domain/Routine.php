<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Routine
 *
 * @author luisd
 */
class Routine {

    private $idRoutine;
    private $idPersonRoutine;
    private $nameRoutine;
    private $seriesRoutine;
    private $repetitionsRoutine;
    private $commentRoutine;
    private $muscleRoutine; //-- 0 = ABDOMEN
                            //-- 1 = SHOULDERS
                            //-- 2 = BICEPS
                            //-- 3 = TRICEPS
                            //-- 4 = CHEST
                            //-- 5 = BACK
                            //-- 6 = LEGS

    function Routine($idRoutine, 
            $idPersonRoutine, 
            $nameRoutine, 
            $seriesRoutine, 
            $repetitionsRoutine, 
            $commentRoutine, 
            $muscleRoutine) {
        $this->idRoutine = $idRoutine;
        $this->idPersonRoutine = $idPersonRoutine;
        $this->nameRoutine = $nameRoutine;
        $this->seriesRoutine = $seriesRoutine;
        $this->repetitionsRoutine = $repetitionsRoutine;
        $this->commentRoutine = $commentRoutine;
        $this->muscleRoutine = $muscleRoutine;
    }

    function getIdRoutine() {
        return $this->idRoutine;
    }

    function getIdPersonRoutine() {
        return $this->idPersonRoutine;
    }

    function getNameRoutine() {
        return $this->nameRoutine;
    }

    function getSeriesRoutine() {
        return $this->seriesRoutine;
    }

    function getRepetitionsRoutine() {
        return $this->repetitionsRoutine;
    }

    function getCommentRoutine() {
        return $this->commentRoutine;
    }

    function getMuscleRoutine() {
        return $this->muscleRoutine;
    }

    function setIdRoutine($idRoutine) {
        $this->idRoutine = $idRoutine;
    }

    function setIdPersonRoutine($idPersonRoutine) {
        $this->idPersonRoutine = $idPersonRoutine;
    }

    function setNameRoutine($nameRoutine) {
        $this->nameRoutine = $nameRoutine;
    }

    function setSeriesRoutine($seriesRoutine) {
        $this->seriesRoutine = $seriesRoutine;
    }

    function setRepetitionsRoutine($repetitionsRoutine) {
        $this->repetitionsRoutine = $repetitionsRoutine;
    }

    function setCommentRoutine($commentRoutine) {
        $this->commentRoutine = $commentRoutine;
    }

    function setMuscleRoutine($muscleRoutine) {
        $this->muscleRoutine = $muscleRoutine;
    }

}
