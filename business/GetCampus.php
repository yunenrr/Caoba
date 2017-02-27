<?php

include './ServiceBusiness1.php';

$serviceBusiness = new ServiceBusiness1();
$result = $serviceBusiness->getCampus();
echo json_encode($result);
?>
