<?php

include './ServiceBusiness1.php';

$serviceBusiness = new ServiceBusiness1();
$result = $serviceBusiness->getPaymentModuleService();
echo json_encode($result);