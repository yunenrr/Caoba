<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Person.php';

/**
 * Description of PersonData
 *
 * @author luisd
 */
class PersonData extends Connector {
    //put your code here

    /**
     * Use to get all people
     * @return array
     */
    public function getAllPersons() {

        $query = "SELECT * FROM TBPerson ORDER BY dniPerson ASC";
        $allPersonsResult = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allPersonsResult)) {
            $currentPerson = new Person($row['idPerson'], $row['dniPerson'], $row['namePerson'], $row['firstNamePerson'], $row['secondNamePerson'], $row['agePerson'], $row['genderPerson'], $row['emailPerson'], $row['addressPerson']);
            array_push($array, $currentPerson);
        }
        return $array;
    }

    /**
     * Use to get a specif person
     * @param type $id
     * @return \Person
     */
    public function getPerson($id) {

        $query = "SELECT * FROM TBPerson WHERE idPerson=" . $id;
        $personResult = $this->exeQuery($query);

        $row = mysqli_fetch_array($personResult);
        $person = new Person(
                $row['idPerson'], $row['dniPerson'], $row['namePerson'], $row['firstNamePerson'], $row['secondNamePerson'], $row['agePerson'], $row['genderPerson'], $row['emailPerson'], $row['addressPerson']);

        return $person;
    }

    /**
     * Used to insert a new person
     * @param type $person
     * @return type
     */
    public function insertPerson($person) {

        $query = "INSERT INTO TBPerson(idPerson,dniPerson,namePerson,firstNamePerson,secondNamePerson,agePerson,genderPerson,emailPerson,addressPerson) "
                . "VALUES ('" . $person->getIdPerson() . "'"
                . ", '" . $person->getDniPerson() . "'"
                . ",'" . $person->getNamePerson() . "'"
                . ",'" . $person->getFirstNamePerson() . "'"
                . ",'" . $person->getSecondNamePerson() . "'"
                . ",'" . $person->getAgePerson() . "'"
                . ",'" . $person->getGenderPerson() . "'"
                . ",'" . $person->getEmailPerson() . "'"
                . ",'" . $person->getAddressPerson() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Use to get the max id num to the people registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("Person");
    }

    /**
     * Use to verify if the dni already exist
     * @param type $dni
     * @return type
     */
    public function verifyDniPerson($dni) {
        $query = "SELECT count(dniPersson) FROM TBPerson WHERE dniPerson=" . $dni;
        $result = $this->exeQuery($query);
        $array = mysqli_fetch_array($result);
        return trim($array[0]);
    }

    /**
     * Update person values
     * @param type $person
     * @return type
     */
    public function updatePerson($person) {
        $query = "UPDATE TBPerson SET "
                . "namePerson  = '" . $person->getNamePerson() . "'"
                . ",firstNamePerson = '" . $person->getFirstNamePerson() . "'"
                . ",secondNamePerson = '" . $person->getSecondNamePerson() . "'"
                . ",agePerson = '" . $person->getAgePerson() . "'"
                . ",genderPerson = '" . $person->getGenderPerson() . "'"
                . ",emailPerson = '" . $person->getEmailPerson() . "'"
                . ",addressPerson = '" . $person->getAddressPerson() . "'"
                . " WHERE idPerson = '" . $person->getIdPerson() . "'";

        return $this->exeQuery($query);
    }

    /**
     * Delete a person by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deletePerson($id) {

        $query = 'DELETE FROM TBPerson WHERE idPerson=' . $id;
        if ($this->exeQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Return return person by typeUser
     * @param 
     * @return all clients array
     */
    public function returnPersonsByTypeData($typeUser) {
        $query = "SELECT p.idPerson,p.dniPerson,p.namePerson,p.firstNamePerson,p.secondNamePerson,p.agePerson,p.genderPerson,"
                . "p.emailPerson,p.addressPerson "
                . "FROM TBPerson AS p INNER JOIN TBUser AS u "
                . "ON p.idPerson=u.idPersonUser "
                . "WHERE u.typeUser =" . $typeUser . "";

        $result = $this->exeQuery($query);
        $personArray = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentPerson = new Person(
                    $row['idPerson'], $row['dniPerson'], $row['namePerson'], $row['firstNamePerson'], $row['secondNamePerson'], $row['agePerson'], $row['genderPerson'], $row['emailPerson'], $row['address']);
            array_push($personArray, $currentPerson);
        }
        return $personArray;
    }

}