<?php
/**
 * Verify the dni people 
 * @author Karen
 * 
 */
include '../business/PersonBusiness.php';
include '../business/UserBusiness.php';

$personBusiness = new PersonBusiness();
$userBusiness = new UserBusiness();


if (isset($_POST['dni'])) {
    $dni = $_POST['dni'];
    $result = $personBusiness->verifyDniPerson($dni);

    if ($result > 0)
        echo true;
    else
        echo false;
}
if (isset($_POST['userName'])) {
    $userNameUser = $_POST['userName'];
    $result = $userBusiness->verifyUserNameUser($userNameUser);
    if ($result > 0)
        echo true;
    else
        echo false;
}

