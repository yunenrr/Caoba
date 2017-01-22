<?php
/**
 * Verify the dni people 
 * @author Karen
 * 
 */
include '../business/PersonBusiness.php';
include '../business/UserBusiness.php';

$personB = new PersonBusiness();
$userB = new UserBusiness();


if (isset($_POST['dni'])) {
    $dni = $_POST['dni'];
    $result = $personB->verifyDniPerson($dni);

    if ($result > 0)
        echo true;
    else
        echo false;
}
if (isset($_POST['userName'])) {
    $userNameUser = $_POST['userName'];
    $result = $userB->verifyUserNameUser($userNameUser);
    if ($result > 0)
        echo true;
    else
        echo false;
}

