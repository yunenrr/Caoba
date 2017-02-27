<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Address
 *
 * @author Karen
 */
class Address {

    //declaración de las variables
    public $idAddress, $neighborhoodAddresss;

    /**
     * Método constructor
     * @param type $idAddress
     * @param type $neighborhoodAddresss
     */
    function __construct($idAddress, $neighborhoodAddresss) {
        $this->idAddress = $idAddress;
        $this->neighborhoodAddresss = $neighborhoodAddresss;
    }//fin del método construcor

    function getIdAddress() {
        return $this->idAddress;
    }

    function getNeighborhoodAddresss() {
        return $this->neighborhoodAddresss;
    }

    function setIdAddress($idAddress) {
        $this->idAddress = $idAddress;
    }

    function setNeighborhoodAddresss($neighborhoodAddresss) {
        $this->neighborhoodAddresss = $neighborhoodAddresss;
    }

}//fin de la clase 
