<?php

include '../business/PersonBusiness.php';

$personBusiness = new PersonBusiness();

// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['dni'])) {

    $person = $personBusiness->getPersonByDNI($_POST['dni']);
    echo (json_encode($person));
} else {

    header("location: ../presentation/MeasurementView.php");
}


