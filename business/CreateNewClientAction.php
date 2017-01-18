<?php
/**
 * Use to Insert perso in the bd
 * 
 * @author Karen
 * 
 */
include './PersonBusiness.php';
include './PhoneBusiness.php';


// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit'])) {

// get form data, making sure it is valid
    $personBusiness = new PersonBusiness();
    $phoneBusiness = new PhoneBusiness();

    $id = $personBusiness->getMaxId();
    $dni = mysql_real_escape_string(htmlspecialchars($_POST['dni']));
    $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
    $firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
    $secondname = mysql_real_escape_string(htmlspecialchars($_POST['secondname']));
    $age = (int) $_POST['age'];
    $gender = (int) $_POST['gender'];
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $address =  mysql_real_escape_string($_POST['address']);

    $indexPhones = 0;

    $person = new Person($id, $dni, $name, $firstname, $secondname, $age, $gender, $email, $address);

    if ($personBusiness->insertPerson($person)) {

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
        header("location: ../presentation/CreateNewClient.php?error=INSERT");
    }
} else {
    header("location: ../presentation/CreateNewClient.php?error=info");
}
?>