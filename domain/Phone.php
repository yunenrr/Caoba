<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonPhone
 *
 * @author luisd
 */
class Phone {

    private $idPhone;
    private $idClientPhone;
    private $numberPhone;

    function Phone($idPhone, $idClientPhone, $numberPhone) {
        $this->idPhone = $idPhone;
        $this->idClientPhone = $idClientPhone;
        $this->numberPhone = $numberPhone;
    }

    function getIdPhone() {
        return $this->idPhone;
    }

    function getIdClientPhone() {
        return $this->idClientPhone;
    }

    function getNumberPhone() {
        return $this->numberPhone;
    }

    function setIdPhone($idPhone) {
        $this->idPhone = $idPhone;
    }

    function setIdClientPhone($idClientPhone) {
        $this->idClientPhone = $idClientPhone;
    }

    function setNumberPhone($numberPhone) {
        $this->numberPhone = $numberPhone;
    }

}
