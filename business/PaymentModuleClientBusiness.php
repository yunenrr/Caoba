<?php

include '../data/PaymentModuleClientData.php';

/**
 * Description of PaymentClientBusiness
 *
 * @author Karen
 */
class PaymentModuleClientBusiness {

    private $paymentModuleClientData;

    public function __construct() {
        $this->paymentModuleClientData = new PaymentModuleClientData();
    }

    public function insertPaymentModuleClient($module) {
        return $this->paymentModuleClientData->insertPaymentModuleClient($module);
    }

    public function insertPayment($idPymentModule, $idclientschedule, $payment, $totalpayment) {
        return $this->paymentModuleClientData->insertPayment($idPymentModule, $idclientschedule, $payment, $totalpayment);
    }

    public function getPaymentModule($idPerson) {
        return $this->paymentModuleClientData->getPaymentModule($idPerson);
    }

}
