<?php

require_once '../data/Connector.php';
include '../domain/ClientRecord.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ClientRecordData
 *
 * @author Edwin
 */
class ClientRecordData extends Connector {

    public function insertClientRecord($clientRecord) {
        $query = "INSERT INTO TBClientRecord "
                . "VALUES('" . $clientRecord->getIdClientRecord()."',"
                . "'" . getDniPersonClientRecord() . "',"
                . "'". getIdServicePaymentModuleClientRecord() . "',"
                . "'" .getIdRelationServiceScheduleClientRecord() . "');";
        
        return $this->exeQuery($query);
    }

    public function updateClientRecord($clientRecord) {
        return $this->exeQuery($query);
    }

    public function deleteClientRecord($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
