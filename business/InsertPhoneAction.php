<?php

include './PhoneBusiness.php';


if (isset($_POST['submit'])) {

    $idPerson = $_POST["idPerson"];
    $namePerson = $_POST["namePerson"];

    if (isset($idPerson) && isset($namePerson)) {

        $indexPhones = 0;
        $name = str_replace("_", " ", $namePerson);

        $phoneBusiness = new PhoneBusiness();

        if (isset($_POST['newPhones'])) {
            $indexPhones = (int) $_POST['newPhones'];
        }


        for ($i = 0; $i <= $indexPhones; $i++) {
            $number = $_POST['newPhone' . $i];
            if (isset($number)&& $number != "") {
                $idPhone = $phoneBusiness->getMaxId();
                $phone = new Phone($idPhone, $idPerson, $number);
                $phoneBusiness->insertPhone($phone);
            }
        }

        header("location: ../presentation/EditPhone.php?id=" . $idPerson . "&name=" . $name . "&success=INSERT");
    } else {
        header("location: ../presentation/EditPhone.php?id=" . $idPerson . "&name=" . $name . "&error=INSERT");
    }
} else {
    header("location: ../presentation/EditPhone.php?id=" . $idPerson . "&name=" . $name . "&error=INSERT");
}
?>
