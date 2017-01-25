<?php

/**
 * Use to Insert perso in the bd
 * 
 * @author Karen
 * 
 */
include './PersonBusiness.php';
include './PhoneBusiness.php';
include './UserBusiness.php';

// get form data, making sure it is valid
$personBusiness = new PersonBusiness();
$phoneBusiness = new PhoneBusiness();
$userBusiness = new UserBusiness();

// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit'])) {

    $dniPerson = mysql_real_escape_string(htmlspecialchars($_POST['dni']));
    $namePerson = mysql_real_escape_string(htmlspecialchars($_POST['name']));
    $firstnamePerson = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
    $secondnamePerson = mysql_real_escape_string(htmlspecialchars($_POST['secondname']));
    $emailPerson = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $addressPerson = mysql_real_escape_string($_POST['address']);
    $passwordUser = mysql_real_escape_string($_POST['password']);
    $nameUser = mysql_real_escape_string($_POST['userName']);
    $phoneReferencePerson = mysql_real_escape_string($_POST['addPhoneReference']);
    $bloodPerson = mysql_real_escape_string($_POST['selBlood']);
    $agePerson = mysql_real_escape_string( $_POST['age']);
    $userType = mysql_real_escape_string( $_POST['userType']);
    $genderPerson = $_POST['selGender'];

    $idPerson = $personBusiness->getMaxId();

    $indexPhones = 0;
    $person = new Person($idPerson, $dniPerson, $namePerson, $firstnamePerson, $secondnamePerson, $agePerson, $genderPerson, $emailPerson, $addressPerson, $phoneReferencePerson, $bloodPerson);

    if ($personBusiness->insertPerson($person)) {

        $idUser = $userBusiness->getMaxId();
        $user = new User($idUser, $dniPerson, $userType, $nameUser, $passwordUser);
        $userBusiness->insertUser($user);

        if (isset($_POST['phones'])) {
            $indexPhones = (int) $_POST['phones'];
        }

        for ($i = 0; $i <= $indexPhones; $i++) {
            $number = $_POST['phone' . $i];
            if (isset($number) && $number != "") {
                $idPhone = $phoneBusiness->getMaxId();
                $phone = new Phone($idPhone, $id, $number);
                $phoneBusiness->insertPhone($phone);
            }
        }


        header("location: ../presentation/ViewClient.php?success=inserted");
    } else {
        header("location: ../presentation/CreateNewClient.php");
    }
} else {
    header("location: ../presentation/CreateNewClient.php?error=info");
}