<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Inventory
 *
 * @author luisd
 */
class Inventory {

    private $idInventory;
    private $nameActiveInventory;
    private $quantityInventory;
    private $priceInventory;
    private $registrationDateInventory;
    private $codeActiveInventory;
    private $locationActiveInventory;

    function Inventory($idInventory, $nameActiveInventory, $quantityInventory, $priceInventory, $registrationDateInventory, $codeActiveInventory, $locationActiveInventory) {
        $this->idInventory = $idInventory;
        $this->nameActiveInventory = $nameActiveInventory;
        $this->quantityInventory = $quantityInventory;
        $this->priceInventory = $priceInventory;
        $this->registrationDateInventory = $registrationDateInventory;
        $this->codeActiveInventory = $codeActiveInventory;
        $this->locationActiveInventory = $locationActiveInventory;
    }

    function getIdInventory() {
        return $this->idInventory;
    }

    function getNameActiveInventory() {
        return $this->nameActiveInventory;
    }

    function getQuantityInventory() {
        return $this->quantityInventory;
    }

    function getPriceInventory() {
        return $this->priceInventory;
    }

    function getRegistrationDateInventory() {
        return $this->registrationDateInventory;
    }

    function getCodeActiveInventory() {
        return $this->codeActiveInventory;
    }

    function getLocationActiveInventory() {
        return $this->locationActiveInventory;
    }

    function setIdInventory($idInventory) {
        $this->idInventory = $idInventory;
    }

    function setNameActveInventory($nameActiveInventory) {
        $this->nameActiveInventory = $nameActveInventory;
    }

    function setQuantityInventory($quantityInventory) {
        $this->quantityInventory = $quantityInventory;
    }

    function setPriceInventory($priceInventory) {
        $this->priceInventory = $priceInventory;
    }

    function setRegistrationDateInventory($registrationDateInventory) {
        $this->registrationDateInventory = $registrationDateInventory;
    }

    function setCodeActiveInventory($codeActiveInventory) {
        $this->codeActiveInventory = $codeActiveInventory;
    }

    function setLocationActiveInventory($locationActiveInventory) {
        $this->locationActiveInventory = $locationActiveInventory;
    }
}
