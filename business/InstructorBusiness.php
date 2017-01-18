<?php
include '../data/InstructorData.php';
/**
 * Clase que nos va a permitir manipular el CRUD de instructores
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
if(isset($_POST['option']))
{
    $option = $_POST['option'];
    
    /**
     * Opciones:
     * 1 - Insertar
     * 2 - Obtener todos los instructores  
     * 3 - Eliminar instructores  
     * 4 - Actualizar instructores 
     */
    switch($option)
    {
        case 1:
            $txtDNI = $_POST['txtDNI'];
            $txtName = $_POST['txtName'];
            $txtFirstSurname = $_POST['txtFirstSurname'];
            $txtSecondSurname = $_POST['txtSecondSurname'];
            $txtAge = $_POST['txtAge'];
            $txtEmail = $_POST['txtEmail'];
            $txtAddress = $_POST['txtAddress'];
            $selGender = $_POST['selGender'];
            
            if($selGender == "F"){$selGender = 0;}
            else{$selGender = 1;}
            
            //Verificamos que no estén vacíos
            if((strlen($txtDNI) > 0) &&
                (strlen($txtName) > 0) &&
                (strlen($txtFirstSurname) > 0) &&
                (strlen($txtSecondSurname) > 0) &&
                (strlen($txtAge) > 0) &&
                (strlen($txtEmail) > 0) &&
                (strlen($txtAddress) > 0))
            {
                $data = new InstructorData();
                $person = new Person(0, $txtDNI, $txtName, $txtFirstSurname, 
                        $txtSecondSurname, $txtAge, $selGender, $txtEmail, $txtAddress);
                echo $data->insertInstructor($person);
            }//Fin del if
            else
            {
                echo "0";
            }
            break;
        case 2:
            $data = new InstructorData();
            $temp = "";
            $array = $data->getAllInstructor();
            
            foreach ($array as $current)
            {   
                $temp = $temp.$current->getIdPerson().",";
                $temp = $temp.$current->getDniPerson().",";
                $temp = $temp.$current->getNamePerson().",";
                $temp = $temp.$current->getFirstNamePerson().",";
                $temp = $temp.$current->getSecondNamePerson().",";
                $temp = $temp.$current->getAgePerson().",";
                $temp = $temp.$current->getGenderPerson().",";
                $temp = $temp.$current->getEmailPerson().",";
                $temp = $temp.$current->getAddressPerson().";";
            }//Fin del foreach
            if(strlen($temp) > 0){$temp = substr($temp,0, strlen($temp)-1);}
            echo $temp;
            break;
        case 3:
            $txtID = $_POST['txtID'];
            $data = new InstructorData();
            echo $data->deleteInstructor($txtID);
            break;
        case 4:
            $txtDNI = $_POST['txtDNI'];
            $txtName = $_POST['txtName'];
            $txtFirstSurname = $_POST['txtFirstSurname'];
            $txtSecondSurname = $_POST['txtSecondSurname'];
            $txtAge = $_POST['txtAge'];
            $txtEmail = $_POST['txtEmail'];
            $txtAddress = $_POST['txtAddress'];
            $selGender = $_POST['selGender'];
            $txtID = $_POST['txtID'];
            
            if($selGender == "F"){$selGender = 0;}
            else{$selGender = 1;}
            
            //Verificamos que no estén vacíos
            if((strlen($txtDNI) > 0) &&
                (strlen($txtName) > 0) &&
                (strlen($txtFirstSurname) > 0) &&
                (strlen($txtSecondSurname) > 0) &&
                (strlen($txtAge) > 0) &&
                (strlen($txtEmail) > 0) &&
                (strlen($txtAddress) > 0))
            {
                $data = new InstructorData();
                $person = new Person($txtID, $txtDNI, $txtName, $txtFirstSurname, 
                        $txtSecondSurname, $txtAge, $selGender, $txtEmail, $txtAddress);
                echo $data->updateInstructor($person);
            }//Fin del if
            else
            {
                echo "0";
            }
            break;
        case 5:break;
    }//Fin del switch
}//Fin del if
