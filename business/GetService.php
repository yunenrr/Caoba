<?php

include './ServiceBusiness1.php';

$serviceBusiness = new ServiceBusiness1();
$result = $serviceBusiness->getAllService();
echo json_encode($result);

?>
