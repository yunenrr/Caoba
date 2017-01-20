<?php

include './PhoneBusiness.php';

$id = $_POST['id'];
$idPerson = $_POST['idPerson'];
$phoneNumber = $_POST['phone'];

if (isset($id) && isset($idPerson) && isset($phoneNumber)) {

    $phoneBusiness = new PhoneBusiness();
    $phone = new Phone($id, $idPerson, $phoneNumber);

    if ($phoneBusiness->updatePhone($phone)) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}
?>