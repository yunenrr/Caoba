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
    $id = $_POST['id'];
    $dni = mysql_real_escape_string(htmlspecialchars($_POST['dni']));
    $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
    $firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
    $secondname = mysql_real_escape_string(htmlspecialchars($_POST['secondname']));
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $address = $_POST['address'];
    
    $person = new Person($id, $dni, $name, $firstname, $secondname, $age, $gender, $email, $address);

    if ($personBusiness->updatePerson($person)) {
        header("location: ../presentation/ViewClient.php?success=UPDATE");
    } else {
        header("location: ../presentation/ViewClient.php?error=UPDATE");
    }
} else {
    header("location: ../presentation/ViewClient.php?error=UPDATE");
}
?>

