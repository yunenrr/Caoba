<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/FamilyParenting.php';

/**
 * Description of FamilyParenting
 *
 * @author Karen
 */
class FamilyParentingData extends Connector {

    /**
     * Used to insert a new Family Parenting
     * @param type $FamilyParenting
     * @return type
     */
    public function insertFamilyParenting($FamilyParenting) {
        $query = "INSERT INTO tbfamilyparenting(idfamilyparenting,idpersonfamilyparenting,idrelativefamilyparenting,idrelationshipfamilyparenting)"
                . "VALUES ('" . $FamilyParenting->getIdFamilyParenting() . "'"
                . ", '" . $FamilyParenting->getIdPersonFamilyParenting() . "'"
                . ",'" . $FamilyParenting->getIdRelativeFamilyParenting() . "'"
                . ",'" . $FamilyParenting->getIdRelationshipFamilyParenting() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Update user values
     * @param type $familyParenting
     * @return type
     */
    public function updateFamilyParenting($familyParenting) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a FamilyParenting by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteFamilyParenting($id) {
        $query = "delete from `tbfamilyparenting` where idfamilyparenting=" . $id;
        if ($this->exeQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Use to get the max id num to the FamilyParenting registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("familyparenting");
    }

    /**
     * Use to get all RelationShip
     * @return array
     */
    public function getAllRelationShip() {

        $query = "select idrelationship, namerelationship from tbrelationship";
        $result = $this->exeQuery($query);
        $arrayResult = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                 $array = array("id" => $row['idrelationship'],
                "name" => $row['namerelationship']
            );
            array_push($arrayResult, $array);
        }
        return json_encode($arrayResult);
    }
    }

    /**
     * Use to get a specific familyParenty
     * @return array
     */
    public function getFamilyParenty($idPerson) {

        $query = "select idfamilyparenting, dniperson,nameperson,firstnameperson,secondnameperson,namerelationship "
                . "from tbfamilyparenting inner join tbperson on idrelativefamilyparenting=idperson "
                . "inner join tbrelationship on idrelationshipfamilyparenting=idrelationship "
                . "where idpersonfamilyparenting=" . $idPerson;

        $result = $this->exeQuery($query);
        $temp = "";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $temp = $temp . $row['idfamilyparenting'] . "," . $row['dniperson'] . "," . $row['nameperson'] . "," .
                        $row['firstnameperson'] . "," . $row['secondnameperson'] . "," . $row['namerelationship'] . ";";
            }
        }
        return $temp;
    }

    /**
     * Use to Check if are already family
     * @param type $idPerson
     * @return type
     */
    public function verifyFamily($idPerson, $idPersonFamilyParenting) {
        $query = "select count(idrelativefamilyparenting) from tbfamilyparenting where idrelativefamilyparenting=" . $idPerson . " and idpersonfamilyparenting=" . $idPersonFamilyParenting;
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        return trim($array[0]);
    }

    /**
     * Use to Check if are Si ya hay padres o madres ingresados
     * @param type $id
     * @return type
     */
    public function verifyFamilyParents($id, $idPersonFamilyParenting) {
        $query = "select count(idrelativefamilyparenting) from tbfamilyparenting where idrelationshipfamilyparenting=" . $id. " and idpersonfamilyparenting=" . $idPersonFamilyParenting;
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        return trim($array[0]);
    } 

    /**
     * Use to get a tree familyParenty
     * @return array
     */
    public function getFamily($idPerson) {

        $query = "select idrelationshipfamilyparenting,nameperson,firstnameperson,secondnameperson,namerelationship "
                . "from tbfamilyparenting inner join tbperson on idrelativefamilyparenting=idperson "
                . "inner join tbrelationship on idrelationshipfamilyparenting=idrelationship "
                . "where idpersonfamilyparenting=" . $idPerson;

        $temp1 = "";
        $temp2 = "";
        $temp3 = "";

        $result = $this->exeQuery($query);
        if (mysqli_num_rows($result) > 0) {
            $temp1 = "<DT>° Padres"; //papás
            $temp2 = "<DD><DL><DT>° Hermanos"; //hermanos
            $temp3 = "<DD><DL><DT>° Hijos"; //hijos

            for ($i = 0; $i < 4; $i++) {
                while ($row = mysqli_fetch_array($result)) {
                    $relation = $row['idrelationshipfamilyparenting'];
                    switch ($relation) {
                        case 1;
                            $temp1 = $temp1."" . "<DD>" . $row['nameperson'] . " " . $row['firstnameperson'] . " " . $row['secondnameperson'] . "";
                            break;
                        case 2;
                            $temp1 = $temp1 . "<DD>" . $row['nameperson'] . " " . $row['firstnameperson'] . " " . $row['secondnameperson'] . "";
                            break;
                        case 3;
                            $temp2 = $temp2 . "<DD>" . $row['nameperson'] . " " . $row['firstnameperson'] . " " . $row['secondnameperson'] . "";
                            break;
                        case 4;
                            $temp2 = $temp2 . "<DD>" . $row['nameperson'] . " " . $row['firstnameperson'] . " " . $row['secondnameperson'] . "";
                            break;
                        case 5;
                            $temp3 = $temp3 . "<DD>" . $row['nameperson'] . " " . $row['firstnameperson'] . " " . $row['secondnameperson'] . "";
                            break;
                    }
                }
            }
            $temp1 = $temp1 . " ";
            $temp2 = $temp2 . "";
            $temp3 = $temp3 . "</DL></DL></DL>";
        }

        return $temp1 . $temp2 . $temp3;
    }

}
