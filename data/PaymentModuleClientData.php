<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/PaymentModuleClient.php';

class PaymentModuleClientData extends Connector {

    public function insertPaymentModuleClient($modulo) {
        $id = $this->getMaxId();
        $query = "INSERT INTO tbpaymentmoduleclient(idpaymentmoduleclient, idpersonpaymentsclient, registrationdatepaymentsclient,"
                . "idpaymentmodulepaymentsclient) values(" .
                $id .
                ",'" . $modulo->getIdpersonpaymentsclient() . "'" .
                ",'" . $modulo->getRegistrationdatepaymentsclient() . "'" .
                ",'" . $modulo->getIdpaymentmodulepaymentsclient() . "');";
        echo $query;
        return $this->exeQuery($query);
    }

    public function insertPayment($idPymentModule, $idclientschedule, $payment, $totalpayment) {

        $id = $this->getMaxIdTable("paymentclient");
        $query = "INSERT INTO tbpaymentclient(idpaymentclient, idpaymentmodulepaymentclient, idclientschedulepaymentclient, paymentpaymentclient, totalpaymentpaymentclient) values(" .
                $id .
                ",'" . $idPymentModule . "'" .
                ",'" . $idclientschedule . "'" .
                ",'" . $payment . "'" .
                ",'" . $totalpayment . "');";
        echo $query;
        return $this->exeQuery($query);
    }

    public function getPaymentModule($idPerson) {
        $query = "SELECT idpaymentmodulepaymentsclient FROM tbpaymentmoduleclient WHERE idpersonpaymentsclient=" . $idPerson;
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        $id = trim($array[0]);
        return $id;
    }

    public function getMaxId() {
        return $this->getMaxIdTable("paymentmoduleclient");
    }

}
