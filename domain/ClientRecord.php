<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientRecord
 *
 * @author Edwin
 */
class ClientRecord {

    private $idClientRecord, $dniPersonClientRecord, $idServicePaymentModuleClientRecord, $idRelationServiceScheduleClientRecord;

    function ClientRecord($idClientRecord, $dniPersonClientRecord, $idServicePaymentModuleClientRecord, $idRelationServiceScheduleClientRecord) {
        $this->idClientRecord = $idClientRecord;
        $this->dniPersonClientRecord = $dniPersonClientRecord;
        $this->idServicePaymentModuleClientRecord = $idServicePaymentModuleClientRecord;
        $this->idRelationServiceScheduleClientRecord = $idRelationServiceScheduleClientRecord;
    }

    function getIdClientRecord() {
        return $this->idClientRecord;
    }

    function getDniPersonClientRecord() {
        return $this->dniPersonClientRecord;
    }

    function getIdServicePaymentModuleClientRecord() {
        return $this->idServicePaymentModuleClientRecord;
    }

    function getIdRelationServiceScheduleClientRecord() {
        return $this->idRelationServiceScheduleClientRecord;
    }

    function setIdClientRecord($idClientRecord) {
        $this->idClientRecord = $idClientRecord;
    }

    function setDniPersonClientRecord($dniPersonClientRecord) {
        $this->dniPersonClientRecord = $dniPersonClientRecord;
    }

    function setIdServicePaymentModuleClientRecord($idServicePaymentModuleClientRecord) {
        $this->idServicePaymentModuleClientRecord = $idServicePaymentModuleClientRecord;
    }

    function setIdRelationServiceScheduleClientRecord($idRelationServiceScheduleClientRecord) {
        $this->idRelationServiceScheduleClientRecord = $idRelationServiceScheduleClientRecord;
    }

}
