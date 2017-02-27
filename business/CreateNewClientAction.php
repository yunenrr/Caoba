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
include '../business/PaymentModuleClientBusiness.php';


// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit'])) {
    // get form data, making sure it is valid
    $personBusiness = new PersonBusiness();
    $phoneBusiness = new PhoneBusiness();
    $userBusiness = new UserBusiness();
    $payBusines= new PaymentModuleClientBusiness();

    $dniPerson = $_POST['dni'];
    $namePerson = $_POST['name'];
    $firstnamePerson = $_POST['firstname'];
    $secondnamePerson = $_POST['secondname'];
    $emailPerson = $_POST['email'];
    $passwordUser = $_POST['password'];
    $nameUser = $_POST['email'];
    $bloodPerson = $_POST['selBlood'];
    $userType = $_POST['userType'];
    $genderPerson = $_POST['selGender'];
    $phoneReferencePerson = $_POST['addPhoneReference'];
    $address = $_POST['selNeighborhood'];

    $idPerson = $personBusiness->getMaxId();
    $birthdayPersonPerson = explode("/", $_POST['birthday']);
    $starDateUser = explode("/", $_POST['startDay']);

    $birthday = $birthdayPersonPerson[2] . "/" . $birthdayPersonPerson[1] . "/" . $birthdayPersonPerson[0];
    $starDate = $starDateUser[2] . "/" . $starDateUser[1] . "/" . $starDateUser[0];

    $indexPhones = 0;
    $person = new Person($idPerson, $dniPerson, $namePerson, $firstnamePerson, $secondnamePerson, $birthday, $genderPerson, $emailPerson, $address, $phoneReferencePerson, $bloodPerson);

    if ($personBusiness->insertPerson($person)) {
        $personStateBusiness = new personStateBusiness();
        $personStateBusiness->insertPersonState($idPerson);
        $idUser = $userBusiness->getMaxId();
        $user = new User($idUser, $idPerson, $userType, $nameUser, $passwordUser, $starDate);
        $userBusiness->insertUser($user);

        if($userType==0){
            $pay= new PaymentModuleClient(0, $idPerson, $starDate, $_POST['selPay']);
            echo $payBusines->insertPaymentModuleClient($pay);
        }
        
        if (isset($_POST['phones'])) {
            $indexPhones = (int) $_POST['phones'];
        }

        for ($i = 0; $i <= $indexPhones; $i++) {
            $number = $_POST['phone' . $i];
            if (isset($number) && $number != "") {
                $idPhone = $phoneBusiness->getMaxId();
                $phone = new Phone($idPhone, $idPerson, $number);
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
?>
<script type="text/javascript" src="../js/qrcode.js">
