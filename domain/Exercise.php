<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Exercise{
    private $idExercise;
    private $nameExercise;
    
    function Exercise($idExercise, $nameExercise) {
        $this->idExercise = $idExercise;
        $this->nameExercise = $nameExercise;
    }
    
    function getIdExercise() {
        return $this->idExercise;
    }

    function getNameExercise() {
        return $this->nameExercise;
    }

    function setIdExercise($idExercise) {
        $this->idExercise = $idExercise;
    }

    function setNameExercise($nameExercise) {
        $this->nameExercise = $nameExercise;
    }

}