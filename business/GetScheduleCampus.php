<?php

include './ServiceBusiness1.php';

$id = $_GET['id'];

if (isset($id)) {
    $serviceBusiness = new ServiceBusiness1();
    $result = $serviceBusiness->getScheduleCampus($id);
    echo json_encode($result);
}

