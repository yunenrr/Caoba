<?php

include './ServiceBusiness1.php';

$idService = (int) $_GET['id'];
if (isset($idService)) {
    $serviceBusiness = new ServiceBusiness1();
    $result = $serviceBusiness->getDayService($idService);
    echo json_encode($result);
}
?>
