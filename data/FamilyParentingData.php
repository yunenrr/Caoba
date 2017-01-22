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
        $query = "INSERT INTO TBFamilyParenting(idFamilyParenting,idPersonFamilyParenting,idRelativeFamilyParenting,idRelationshipFamilyParenting)"
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
        $query = "DELETE FROM `TBFamilyParenting` WHERE idFamilyParenting=" . $id;
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
        return $this->getMaxIdTable("FamilyParenting");
    }

    /**
     * Use to get all RelationShip
     * @return array
     */
    public function getAllRelationShip() {

        $query = "SELECT `idRelationship`, `nameRelationship` FROM `TBRelationShip`";
        $result = $this->exeQuery($query);
        $temp = "";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $temp = $temp . $row['idRelationship'] . "," . $row['nameRelationship'] . ";";
            }
        }
        return $temp;
    }

    /**
     * Use to get a specific familyParenty
     * @return array
     */
    public function getFamilyParenty($idPerson) {

        $query = "SELECT idFamilyParenting, dniPerson,namePerson,firstNamePerson,secondNamePerson,nameRelationship "
                . "FROM TBFamilyParenting INNER JOIN TBPerson ON IdRelativeFamilyParenting=idPerson "
                . "INNER JOIN TBRelationship ON idRelationshipFamilyParenting=idRelationship "
                . "WHERE idPersonFamilyParenting=" . $idPerson;

        $result = $this->exeQuery($query);
        $temp = "";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $temp = $temp . $row['idFamilyParenting'] . "," . $row['dniPerson'] . "," . $row['namePerson'] . "," .
                        $row['firstNamePerson'] . "," . $row['secondNamePerson'] . "," . $row['nameRelationship'] . ";";
            }
        }
        return $temp;
    }

    /**
     * Use to Check if are already family
     * @param type $idPerson
     * @return type
     */
    public function verifyFamily($idPerson) {
        $query = "SELECT count(idRelativeFamilyParenting) FROM TBFamilyParenting WHERE idRelativeFamilyParenting=" . $idPerson;
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        return trim($array[0]);
    }
}
