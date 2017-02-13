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
include '../business/PersonStateBusiness.php';


// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit'])) {
    // get form data, making sure it is valid
    $personBusiness = new PersonBusiness();
    $phoneBusiness = new PhoneBusiness();
    $userBusiness = new UserBusiness();

    $dniPerson = $_POST['dni'];
    $namePerson = $_POST['name'];
    $firstnamePerson = $_POST['firstname'];
    $secondnamePerson = $_POST['secondname'];
    $emailPerson = $_POST['email'];
    $passwordUser = $_POST['password'];
    $nameUser =$_POST['userName'];
    $phoneReferencePerson = $_POST['addPhoneReference'];
    $bloodPerson =$_POST['selBlood'];
    $birthdayPersonPerson = $_POST['birthday'];
    $userType = $_POST['userType'];
    $genderPerson = $_POST['selGender'];
    $starDateUser = $_POST['startDay'];
    $address = $_POST['selNeighborhood'];

    $idPerson = $personBusiness->getMaxId();

    $indexPhones = 0;
    $person = new Person($idPerson, $dniPerson, $namePerson, $firstnamePerson, $secondnamePerson, $birthdayPersonPerson, $genderPerson, $emailPerson, $address, $phoneReferencePerson, $bloodPerson);

    if ($personBusiness->insertPerson($person)) {
        $personStateBusiness = new personStateBusiness();
        $personStateBusiness->insertPersonState($idPerson);
        $idUser = $userBusiness->getMaxId();
        $user = new User($idUser, $idPerson, $userType, $nameUser, $passwordUser, $starDateUser);
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


        header("location: ../presentation/Person.php?success=inserted");
    } else {
        header("location: ../presentation/Person.php");
    }
} else {
    header("location: ../presentation/Person.php?error=info");
}
