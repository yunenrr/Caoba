<?php

include './ServiceBusiness1.php';

$idService = (int) $_GET['idService'];

if (isset($idService)) {
    $serviceBusiness = new ServiceBusiness1();
    $result = $serviceBusiness->getCampusService($idService);
    echo json_encode($result);
}
?>
