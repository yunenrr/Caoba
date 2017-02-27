<?php

include './ServiceBusiness1.php';
session_start();


$startdateclientschedule = new DateTime($_GET['date']);
$enddateclientschedule = new DateTime($_GET['date']);
$idModule = $_GET['module'];
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
$hour = $_GET['hour'];
$day = $_GET['day'];
$idService = $_GET['idService'];

if (isset($startdateclientschedule) && isset($hour) && isset($day) && isset($idModule) && isset($idService)) {

    $serviceBusiness1 = new ServiceBusiness1();
    $id = $serviceBusiness1->getMaxId();

    $quota = (int) $serviceBusiness1->getQuota($idService);
    if ($quota > 0) {
        if ($serviceBusiness1->insertServiceToClient($id, $_SESSION['id'], $startdateclientschedule->format('Y-m-d'), $enddateclientschedule->format('Y-m-d'), $hour, $day, $idModule, $idService)) {
            echo true;
        } else {
            echo false;
        }
    } else {
        echo false;
    }
} else {
    echo false;
}




