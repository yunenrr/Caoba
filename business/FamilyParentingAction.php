<?php

include './PersonBusiness.php';
include './FamilyParentingBusiness.php';

if (isset($_POST['option'])) {
    $option = $_POST['option'];

    $relationshipBusiness = new FamilyParentingBusiness();
//echo json_encode($relationshipBusiness->getAllRelationShip());
    switch ($option) {
        case 1:// ingresa un familiar a la base
            $idPersonFamilyParenting = $_POST['idPerson'];
            $idRelativeFamilyParenting = $_POST['selFamilyParenting'];
            $idRelationshipFamilyParenting = $_POST['selRelationShip'];

            // se valida que el cliente selecionado como familia no se haya ingresado antes.
            if ($relationshipBusiness->verifyFamily($idRelativeFamilyParenting, $idPersonFamilyParenting) > 0) {
                echo 'Esta persona ya fue ingresada como familiar!!';
            } else {// se ingresa a la base 
                if ($idRelationshipFamilyParenting == 1 || $idRelationshipFamilyParenting == 2) {

                    if ($relationshipBusiness->verifyFamilyParents($idRelationshipFamilyParenting, $idPersonFamilyParenting) > 0) {

                        if ($idRelationshipFamilyParenting == 1) {
                            echo "Ya tiene un padre registrado!!";
                        } else {
                            echo "Ya tiene una madre registrada!!";
                        }
                    } else {
                        $idFamilyParenting = $relationshipBusiness->getMaxId();
                        $family = new FamilyParenting($idFamilyParenting, $idPersonFamilyParenting, $idRelativeFamilyParenting, $idRelationshipFamilyParenting);
                        echo $relationshipBusiness->insertFamilyParenting($family);
                    }
                } else {
                    $idFamilyParenting = $relationshipBusiness->getMaxId();
                    $family = new FamilyParenting($idFamilyParenting, $idPersonFamilyParenting, $idRelativeFamilyParenting, $idRelationshipFamilyParenting);
                    echo $relationshipBusiness->insertFamilyParenting($family);
                }
            }

            break;
        case 2:// obtengo a todas los clientes de la base 
            $personBusiness = new PersonBusiness();
            $array = $personBusiness->getAllPersons();
            $temp = "";
            foreach ($array as $current) {
                $temp = $temp . $current->getIdPerson() . ",";
                $temp = $temp . $current->getNamePerson() . " " . $current->getFirstNamePerson() . "  " . $current->getSecondNamePerson() . ";";
            }//Fin del foreach 
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;
        case 3:
            // obtengo las relaciones que componen a una familia
            $temp = $relationshipBusiness->getAllRelationShip();
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;
        case 4:
            //obtengo a la familia de una persona en especifico
            $idPersonFamilyParenting = mysql_real_escape_string(htmlspecialchars($_POST['idPerson']));
            $temp = $relationshipBusiness->getFamilyParenty($idPersonFamilyParenting);
            if (strlen($temp) > 0) {
                $temp = substr($temp, 0, strlen($temp) - 1);
            }
            echo $temp;
            break;

        case 5:// elimino a un mienbro de la familia
            $idFamilyParenting = mysql_real_escape_string(htmlspecialchars($_POST['txtID']));
            echo $relationshipBusiness->deleteFamilyParenting($idFamilyParenting);
            break;

        case 6:// family tree
            $idFamilyParenting = mysql_real_escape_string(htmlspecialchars($_POST['idPerson']));
            echo $relationshipBusiness->getFamily($idFamilyParenting);
            break;
    }
}