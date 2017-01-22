<?php

/**
 * Use to update person in the BD
 * 
 * @karen
 */
include '../business/PersonBusiness.php';

$personBusiness = new PersonBusiness();

// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit'])) {

// get form data, making sure it is valid
    $idPerson = mysql_real_escape_string(htmlspecialchars($_POST['id']));
    $dniPerson = mysql_real_escape_string(htmlspecialchars($_POST['dni']));
    $namePerson = mysql_real_escape_string(htmlspecialchars($_POST['name']));
    $firstnamePerson = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
    $secondnamePerson = mysql_real_escape_string(htmlspecialchars($_POST['secondname']));
    $agePerson = mysql_real_escape_string(htmlspecialchars($_POST['age']));
    $genderPerson = mysql_real_escape_string(htmlspecialchars($_POST['gender']));
    $emailPerson = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $addressPerson = mysql_real_escape_string($_POST['address']);
    $phoneReferencePerson = mysql_real_escape_string($_POST['addPhoneReference']);
    $bloodPerson = mysql_real_escape_string($_POST['selBlood']);
//    $passwordUser = mysql_real_escape_string($_POST['password']);
//    $nameUser = mysql_real_escape_string($_POST['userName']);
    $person = new Person($idPerson, $dniPerson, $namePerson, $firstnamePerson, $secondnamePerson,
            $agePerson, $genderPerson, $emailPerson, $addressPerson, $phoneReferencePerson, $bloodPerson);

    if ($personBusiness->updatePerson($person)) {
        header("location: ../presentation/ViewClient.php?success=UPDATE");
    } else {
        header("location: ../presentation/ViewClient.php?error=UPDATE");
    }
} else {
    header("location: ../presentation/ViewClient.php?error=UPDATE");
}
?>

