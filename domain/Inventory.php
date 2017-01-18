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
    private $nameInventory;
    private $quantityInventory;
    private $priceInventory;
    private $registrationDateInventory;

    function Inventory($idInventory, $nameInventory, $quantityInventory, $priceInventory, $registrationDateInventory) {
        $this->idInventory = $idInventory;
        $this->nameInventory = $nameInventory;
        $this->quantityInventory = $quantityInventory;
        $this->priceInventory = $priceInventory;
        $this->registrationDateInventory = $registrationDateInventory;
    }

    function getIdInventory() {
        return $this->idInventory;
    }

    function getNameInventory() {
        return $this->nameInventory;
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

    function setIdInventory($idInventory) {
        $this->idInventory = $idInventory;
    }

    function setNameInventory($nameInventory) {
        $this->nameInventory = $nameInventory;
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

}
