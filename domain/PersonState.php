<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonState
 *
 * @author luisd
 */
class PersonState {

    private $idPersonState;
    private $idClientPersonState;
    private $statePersonState;

    function __construct($idPersonState, $idClientPersonState, $statePersonState) {
        $this->idPersonState = $idPersonState;
        $this->idClientPersonState = $idClientPersonState;
        $this->statePersonState = $statePersonState;
    }

    function getIdPersonState() {
        return $this->idPersonState;
    }

    function getIdClientPersonState() {
        return $this->idClientPersonState;
    }

    function getStatePersonState() {
        return $this->statePersonState;
    }

    function setIdPersonState($idPersonState) {
        $this->idPersonState = $idPersonState;
    }

    function setIdClientPersonState($idClientPersonState) {
        $this->idClientPersonState = $idClientPersonState;
    }

    function setStatePersonState($statePersonState) {
        $this->statePersonState = $statePersonState;
    }

}
