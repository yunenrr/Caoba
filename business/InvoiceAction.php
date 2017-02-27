<?php

include '../data/ScheduleClientData.php';
include '../business/PaymentModuleClientBusiness.php';

$id = $_POST['id'];
$option = $_POST['option'];
$payment = new ScheduleClientData();
$pay = new PaymentModuleClientBusiness();
$array = $payment->getAllServiceClient($id);
$paymentType = $pay->getPaymentModule($id);

if ($option == "1") {

    $paymentTypeClient = 0;
    switch ($paymentType) {

        case 2: $paymentTypeClient = 7;
            break;
        case 3: $paymentTypeClient = 15;
            break;
        case 4: $paymentTypeClient = 30;
            break;
    }
    if (sizeof($array) > 0) {
        foreach ($array as $value) {

            $paymentTypeService = 0;
            switch ($value['paymentmodule']) {
                case 1: $paymentTypeService = 1;
                    break;
                case 2: $paymentTypeService = 7;
                    break;
                case 3: $paymentTypeService = 15;
                    break;
                case 4: $paymentTypeService = 30;
                    break;
                case 5: $paymentTypeService = 1;
                    break;
            }
            $periodo = round($value['days'] / $paymentTypeClient);
            $periodosesion = round($value['days'] / $paymentTypeService);
            $total = $value['price'] * $periodosesion;
            $abono = $total / $periodo;
            echo $pay->insertPayment(1, $value['idclientschedule'], $abono, $total);
        }
    }
} else {
    echo $payment->updateInvoice($id);
}
