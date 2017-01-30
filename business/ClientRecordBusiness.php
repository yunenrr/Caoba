<?php

include '../data/ClientRecordData.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientRecordBusiness
 *
 * @author Edwin
 */
class ClientRecordBusiness {

//put your code here
    private $clientRecordData;

    public function ClientRecordBusiness() {
        return $this->clientRecordData = new ClientRecordData();
    }

    public function insertcClientRecord($diet) {
        return $this->clientRecordData->insertClientRecord($diet);
    }

    public function deleteClientRecord($id) {
        return $this->clientRecordData->deleteClientRecord($id);
    }

    public function updateClientRecord($diet) {
        return $this->clientRecordData->updateClientRecord($diet);
    }

    function dateOfEntryIntoService($id) {
        return $this->clientRecordData->dateOfEntryIntoService($id);
    }

    public function returnsRegisteredServices($id) {
        return $this->clientRecordData->returnsRegisteredServices($id);
    }

}
