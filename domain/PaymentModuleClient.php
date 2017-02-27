<?php

/**
 * Description of PaymentClient
 *
 * @author Karen
 */
class PaymentModuleClient {

    private $idpaymentsclient;
    private $idpersonpaymentsclient;
    private $registrationdatepaymentsclient;
    private $idpaymentmodulepaymentsclient;

    function PaymentModuleClient($idpaymentsclient, $idpersonpaymentsclient, $registrationdatepaymentsclient, $idpaymentmodulepaymentsclient) {
        $this->idpaymentsclient = $idpaymentsclient;
        $this->idpersonpaymentsclient = $idpersonpaymentsclient;
        $this->registrationdatepaymentsclient = $registrationdatepaymentsclient;
        $this->idpaymentmodulepaymentsclient = $idpaymentmodulepaymentsclient;
    }
    
    function getIdpaymentsclient() {
        return $this->idpaymentsclient;
    }

    function getIdpersonpaymentsclient() {
        return $this->idpersonpaymentsclient;
    }

    function getRegistrationdatepaymentsclient() {
        return $this->registrationdatepaymentsclient;
    }

    function getIdpaymentmodulepaymentsclient() {
        return $this->idpaymentmodulepaymentsclient;
    }

    function setIdpaymentsclient($idpaymentsclient) {
        $this->idpaymentsclient = $idpaymentsclient;
    }

    function setIdpersonpaymentsclient($idpersonpaymentsclient) {
        $this->idpersonpaymentsclient = $idpersonpaymentsclient;
    }

    function setRegistrationdatepaymentsclient($registrationdatepaymentsclient) {
        $this->registrationdatepaymentsclient = $registrationdatepaymentsclient;
    }

    function setIdpaymentmodulepaymentsclient($idpaymentmodulepaymentsclient) {
        $this->idpaymentmodulepaymentsclient = $idpaymentmodulepaymentsclient;
    }



}
