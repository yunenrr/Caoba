<?php

include './ServiceBusiness1.php';
session_start();

//$startdateclientschedule = date($_GET['date']);
//$startdateclientschedule = date($_GET['date']);
$startdateclientschedule = date($_GET['date']);
$enddateclientschedule = strtotime("$startdateclientschedule");

$idModule = $_GET['module'];
//$idModule = 4;

switch ($idModule) {
    case 1:
        $enddateclientschedule = strtotime("1 day", $enddateclientschedule);
        break;
    case 2:
        $enddateclientschedule = strtotime("1 week", $enddateclientschedule);
        break;
    case 3:
        $enddateclientschedule = strtotime("2 week", $enddateclientschedule);
        break;
    case 4:
        $enddateclientschedule = strtotime("1 month", $enddateclientschedule);
        break;
    case 5:
        $enddateclientschedule = strtotime("1 day", $enddateclientschedule);
        break;

    default:
//        strtotime("$periodicity day", "$enddateclientschedule");
        break;
}

//echo "\n" . date("Y-m-d", $enddateclientschedule);

//exit;


$hour = $_GET['hour'];
$day = $_GET['day'];
$idService = $_GET['idService'];

if (isset($startdateclientschedule) && isset($hour) && isset($day) && isset($idModule) && isset($idService)) {

    $serviceBusiness1 = new ServiceBusiness1();
    $id = $serviceBusiness1->getMaxId();

    $quota = (int) $serviceBusiness1->getQuota($idService);
    if ($quota > 0) {
//        if ($serviceBusiness1->insertServiceToClient($id, $_SESSION['id'], $startdateclientschedule->format('d-m-Y'), $enddateclientschedule->format('Y-m-d'), $hour, $day, $idModule, $idService)) {
        if ($serviceBusiness1->insertServiceToClient($id, $_SESSION['id'], $startdateclientschedule, date("Y-m-d", $enddateclientschedule), $hour, $day, $idModule, $idService)) {
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




