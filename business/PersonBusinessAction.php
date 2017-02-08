<?php

include './PersonBusiness.php';
include './UserBusiness.php';
include './PersonStateBusiness.php';

if (isset($_POST['option'])) {
    $option = $_POST['option'];

    $personBusiness = new PersonBusiness();

    switch ($option) {
        case 1:  //mostrar las personas
            $gender = $personBusiness->GetAllGender();
            $array = $personBusiness->getAllPersons();
            $personStateBusiness = new personStateBusiness();

            $temp = "";
            foreach ($array as $current) {
                $tempGender = "";
                foreach ($gender as $value) {
                    if ($current->getGenderPerson() == $value->getIdGender()) {
                        $tempGender = $value->getNameGender();
                    }
                }
                $state = "";
                if ($personStateBusiness->getPersonStateBusiness($current->getDniPerson()) == "1") {
                    $state = "Active";
                } else {
                    $state = "Inactive";
                }
                $temp = $temp.",".$current->getIdPerson() . ",". $current->getDniPerson() . "," . $current->getNamePerson() . ","
                        . $current->getFirstNamePerson() . "," . $current->getSecondNamePerson() . ","
                        . $current->getAgePerson() . "," . $tempGender . "," . $current->getEmailPerson() . ","
                        . $current->getPhoneReferencePerson() . "," . $current->getBloodTypePerson() . "," . $state . ";";
            }//Fin del foreach 
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;
        case 2:  //validate dni
            $dni = $_POST['dni'];
            $result = $personBusiness->verifyDniPerson($dni);

            if ($result > 0)
                echo '1';
            else
                echo '0';
            break;
        case 3: //validate username
            $userBusiness = new UserBusiness();
            $userNameUser = $_POST['userName'];
            $result = $userBusiness->verifyUserNameUser($userNameUser);
            if ($result > 0)
                echo '1';
            else
                echo '0';
            break;
        case 4: 
            
            break;
    }
}
            