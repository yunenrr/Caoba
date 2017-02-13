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
    private $idgoodsinventory;
    private $statusinventory;
    private $quantityinventory;
    private $locationActiveInventory;

    function Inventory($idInventory, $idgoodsinventory, $statusinventory, $quantityinventory, $locationActiveInventory) {
        $this->idInventory = $idInventory;
        $this->idgoodsinventory = $idgoodsinventory;
        $this->statusinventory = $statusinventory;
        $this->quantityinventory = $quantityinventory;
        $this->locationActiveInventory = $locationActiveInventory;
    }

    function getIdInventory() {
        return $this->idInventory;
    }

    function getIdgoodsinventory() {
        return $this->idgoodsinventory;
    }

    function getStatusinventory() {
        return $this->statusinventory;
    }

    function getQuantityinventory() {
        return $this->quantityinventory;
    }

    function getLocationActiveInventory() {
        return $this->locationActiveInventory;
    }

    function setIdInventory($idInventory) {
        $this->idInventory = $idInventory;
    }

    function setIdgoodsinventory($idgoodsinventory) {
        $this->idgoodsinventory = $idgoodsinventory;
    }

    function setStatusinventory($statusinventory) {
        $this->statusinventory = $statusinventory;
    }

    function setQuantityinventory($quantityinventory) {
        $this->quantityinventory = $quantityinventory;
    }

    function setLocationActiveInventory($locationActiveInventory) {
        $this->locationActiveInventory = $locationActiveInventory;
    }

}
