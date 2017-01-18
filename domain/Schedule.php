<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Schedule
 *
 * @author luisd
 */
class Schedule {

    private $idSchedule;
    private $checkInSchedule;
    private $checkOutSchedule;

    function Schedule($idSchedule, $checkInSchedule, $checkOutSchedule) {
        $this->idSchedule = $idSchedule;
        $this->checkInSchedule = $checkInSchedule;
        $this->checkOutSchedule = $checkOutSchedule;
    }

    function getIdSchedule() {
        return $this->idSchedule;
    }

    function getCheckInSchedule() {
        return $this->checkInSchedule;
    }

    function getCheckOutSchedule() {
        return $this->checkOutSchedule;
    }

    function setIdSchedule($idSchedule) {
        $this->idSchedule = $idSchedule;
    }

    function setCheckInSchedule($checkInSchedule) {
        $this->checkInSchedule = $checkInSchedule;
    }

    function setCheckOutSchedule($checkOutSchedule) {
        $this->checkOutSchedule = $checkOutSchedule;
    }

}
