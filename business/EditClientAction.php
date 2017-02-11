<?php

/**
 * Use to update person in the BD
 * 
 * @karen
 */
include '../business/PersonBusiness.php';
include '../business/UserBusiness.php';

$personBusiness = new PersonBusiness();
$userBusiness= new UserBusiness();

// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit'])) {

// get form data, making sure it is valid
    $idPerson = $_POST['id'];
    $dniPerson = $_POST['dni'];
    $namePerson = $_POST['name'];
    $firstnamePerson = $_POST['firstname'];
    $secondnamePerson = $_POST['secondname'];
    $birthdayPerson = $_POST['birthday'];
    $genderPerson = $_POST['selGender'];
    $emailPerson = $_POST['email'];
    $addressPerson = $_POST['selNeighborhood'];
    $phoneReferencePerson = $_POST['addPhoneReference'];
    $bloodPerson = $_POST['selBlood'];
    $passUser = $_POST['password'];
    $userNameUser = $_POST['userName'];
    
    $person = new Person($idPerson, $dniPerson, $namePerson, $firstnamePerson, $secondnamePerson, $birthdayPerson, $genderPerson, $emailPerson, $addressPerson, $phoneReferencePerson, $bloodPerson);
    $user= new User(0, $dniPerson, 0, $userNameUser, $passUser);
    
    if ($personBusiness->updatePerson($person)) {
        $userBusiness->updateUser($user);
        header("location: ../presentation/EditClient.php?success=UPDATE");
    } else {
        header("location: ../presentation/EditClient.php?error=UPDATE");
    }
} else {
    header("location: ../presentation/EditClient.php?error=UPDATE");
}
?>

