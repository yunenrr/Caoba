<?php

include './ServiceBusiness1.php';
session_start();

if (isset($_POST['submit'])) {

    $startdateclientschedule = $_POST['startDay'];
    $hour = (int) $_POST['comboHourStart'];
    $day = (int) $_POST['comboDay'];
    $idModule = (int) $_POST['comboPaymentModule'];
    $idService = (int) $_POST['comboService'];
    
    if (isset($startdateclientschedule) && isset($hour) && isset($day) && isset($idModule) && isset($idService)) {

        $serviceBusiness1 = new ServiceBusiness1();
        $id = $serviceBusiness1->getMaxId();

        if ($serviceBusiness1->insertServiceToClient($id, $_SESSION['id'], $startdateclientschedule, $hour, $day, $idModule, $idService)) {

            header("location: ../presentation/ChooseService.php?success=inserted");
        } else {
            header("location: ../presentation/ChooseService.php?error=inserted");
        }
    }
} else {
    header("location: ../presentation/ViewClient.php?error=insert_Payment_Module");
}



