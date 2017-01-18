<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Record
 *
 * @author luisd
 */
class Record {

    private $idRecord;
    private $idPersonRecord;
    private $registerDateRecord;
    private $paymentDateRecord;

    function Record($idRecord, $idPersonRecord, $registerDateRecord, $paymentDateRecord) {
        $this->idRecord = $idRecord;
        $this->idPersonRecord = $idPersonRecord;
        $this->registerDateRecord = $registerDateRecord;
        $this->paymentDateRecord = $paymentDateRecord;
    }

    function getIdRecord() {
        return $this->idRecord;
    }

    function getIdPersonRecord() {
        return $this->idPersonRecord;
    }

    function getRegisterDateRecord() {
        return $this->registerDateRecord;
    }

    function getPaymentDateRecord() {
        return $this->paymentDateRecord;
    }

    function setIdRecord($idRecord) {
        $this->idRecord = $idRecord;
    }

    function setIdPersonRecord($idPersonRecord) {
        $this->idPersonRecord = $idPersonRecord;
    }

    function setRegisterDateRecord($registerDateRecord) {
        $this->registerDateRecord = $registerDateRecord;
    }

    function setPaymentDateRecord($paymentDateRecord) {
        $this->paymentDateRecord = $paymentDateRecord;
    }

}
