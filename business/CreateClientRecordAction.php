<?php

include './ServiceBusiness1.php';
session_start();

if (isset($_POST['submit'])) {

    $startdateclientschedule = new DateTime($_POST['startDay']);
    $idModule = (int) $_POST['comboPaymentModule'];
    $enddateclientschedule = new DateTime($_POST['startDay']);
    switch ($idModule) {
        case 1:
            $enddateclientschedule->add(new DateInterval('P1D'));
            break;
        case 2:
            $enddateclientschedule->add(new DateInterval('P1W'));
            break;
        case 3:
            $enddateclientschedule->add(new DateInterval('P2W'));
            break;
        case 4:
            $enddateclientschedule->add(new DateInterval('P1M'));
            break;
        case 5:
            $enddateclientschedule->add(new DateInterval('P1D'));
            break;

        default:
            $enddateclientschedule = new DateTime($_POST['startDay']);
            break;
    }
    $hour = (int) $_POST['comboHourStart'];
    $day = (int) $_POST['comboDay'];
    $idModule = (int) $_POST['comboPaymentModule'];
    $idService = (int) $_POST['comboService'];

    if (isset($startdateclientschedule) && isset($hour) && isset($day) && isset($idModule) && isset($idService)) {

        $serviceBusiness1 = new ServiceBusiness1();
        $id = $serviceBusiness1->getMaxId();

        $quota = (int) $serviceBusiness1->getQuota($idService);
        if ($quota > 0) {
            if ($serviceBusiness1->insertServiceToClient($id, $_SESSION['id'], $startdateclientschedule->format('Y-m-d'), $enddateclientschedule->format('Y-m-d'), $hour, $day, $idModule, $idService)) {

                header("location: ../presentation/ChooseService.php?success=inserted");
            } else {
                header("location: ../presentation/ChooseService.php?error=inserted");
            }
        } else {
            header("location: ../presentation/ChooseService.php?qouta=FULL");
        }
    } else {
        header("location: ../presentation/ChooseService.php?error=DATA");
    }
} else {
    header("location: ../presentation/ChooseService.php?error=SUBMIT");
}



