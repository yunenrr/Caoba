<?php

//header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Person.php';
include '../domain/Gender.php';

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

        $query = "SELECT `idperson`, `dniperson`, `nameperson`, `firstnameperson`, "
                . "`secondnameperson`, `birthdayperson`, `genderperson`, `emailperson`, `neighborhoodaddress`, "
                . "`phonereferenceperson`, `bloodtypeperson` FROM `tbperson` LEFT OUTER JOIN  `tbaddress` ON `idaddress`=`addressperson`";

        $allPersonsResult = $this->exeQuery($query);
        $array = [];
        if (mysqli_num_rows($allPersonsResult) > 0) {
            while ($row = mysqli_fetch_array($allPersonsResult)) {
                $currentPerson = new Person($row['idperson'], $row['dniperson'], $row['nameperson'], $row['firstnameperson'], $row['secondnameperson'], $row['birthdayperson'], $row['genderperson'], $row['emailperson'], $row['neighborhoodaddress'], $row['phonereferenceperson'], $row['bloodtypeperson']);
                array_push($array, $currentPerson);
            }
        }
        return $array;
    }

    /**
     * Use to get a specif person
     * @param type $id
     * @return \Person
     */
    public function getPerson($id) {

        $query = "select tbperson.idperson,dniperson,nameperson,firstnameperson,secondnameperson,birthdayperson,genderperson, emailperson,addressperson,phonereferenceperson,bloodtypeperson from tbperson where idperson= '" . $id. "'";

        $personResult = $this->exeQuery($query);

        $row = mysqli_fetch_array($personResult);
        $person = new Person($row['idperson'], $row['dniperson'], $row['nameperson'], $row['firstnameperson'], $row['secondnameperson'], $row['birthdayperson'], $row['genderperson'], $row['emailperson'], $row['addressperson'], $row['phonereferenceperson'], $row['bloodtypeperson']);
        return $person;
    }

    public function getPersonByDNI($id) {
        $query = "select * from tbperson where idperson=" . $id;
        $personResult = $this->exeQuery($query);
        $row = mysqli_fetch_array($personResult);
        $array[] = array("idperson" => $row['idperson'],
            "dniperson" => $row['dniperson'],
            "nameperson" => $row['nameperson'],
            "firstnamePerson" => $row['firstnameperson'],
            "secondnameperson" => $row['secondnameperson'],
            "birthdayperson'" => $row['birthdayperson'],
            "genderperson" => $row['genderperson'],
            "emailperson" => $row['emailperson'],
            "addressperson" => $row['addressperson'],
            "phonereferenceperson" => $row['phonereferenceperson'],
            "bloodtypeperson" => $row['bloodtypeperson']
        );
        return $array;     
    }

    /**
     * Used to insert a new person
     * @param type $person
     * @return type
     */
    public function insertPerson($person) {

        $query = "INSERT INTO tbperson(idperson,dniperson,nameperson,firstnameperson,secondnameperson,birthdayperson,genderperson,emailperson,addressperson, phonereferenceperson, bloodtypeperson)"
                . "VALUES ('" . $person->getIdPerson() . "'"
                . ",'" . $person->getDniPerson() . "'"
                . ",'" . $person->getNamePerson() . "'"
                . ",'" . $person->getFirstNamePerson() . "'"
                . ",'" . $person->getSecondNamePerson() . "'"
                . ",'" . $person->getBirthdayPerson() . "'"
                . ",'" . $person->getGenderPerson() . "'"
                . ",'" . $person->getEmailPerson() . "'"
                . ",'" . $person->getAddressPerson() . "'"
                . ",'" . $person->getPhoneReferencePerson() . "'"
                . ",'" . $person->getBloodTypePerson() . "');";
        return $this->exeQuery($query);
    }

    /**
     * Use to get the max id num to the people registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("person");
    }

    /**
     * Use to verify if the dni already exist
     * @param type $dni
     * @return type
     */
    public function verifyDniPerson($dni) {
        $query = "SELECT count(dniperson) FROM tbperson WHERE dniperson = '" . $dni . "' ";
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
        $query = "UPDATE tbperson SET "
                . "nameperson  = '" . $person->getNamePerson() . "'"
                . ",firstnameperson = '" . $person->getFirstNamePerson() . "'"
                . ",secondnameperson = '" . $person->getSecondNamePerson() . "'"
                . ",birthdayperson = '" . $person->getBirthdayPerson() . "'"
                . ",genderperson = '" . $person->getGenderPerson() . "'"
                . ",emailperson = '" . $person->getEmailPerson() . "'"
                . ",addressperson = '" . $person->getAddressPerson() . "'"
                . ",phonereferenceperson = '" . $person->getPhoneReferencePerson() . "'"
                . ",bloodtypeperson = '" . $person->getBloodTypePerson() . "'"
                . " WHERE idperson = '" . $person->getIdPerson() . "'";

        return $this->exeQuery($query);
    }

    /**
     * Delete a person by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deletePerson($id) {
        $query = 'DELETE FROM tbperson WHERE idperson=' . $id;
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
        $query = "SELECT * "
                . "FROM tbperson AS p INNER JOIN tbuser AS u "
                . "ON p.dniperson=u.idpersonuser "
                . "WHERE u.typeuser =" . $typeUser . "";

        $result = $this->exeQuery($query);
        $personArray = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentPerson = new Person(
                    $row['idperson'], $row['dniperson'], $row['nameperson'], $row['firstnameperson'], $row['secondnameperson'], $row['birthdayperson'], $row['genderperson'], $row['emailperson'], $row['addressperson'], $row['phonereferenceperson'], $row['bloodtypeperson']);
            array_push($personArray, $currentPerson);
        }
        return $personArray;
    }

    /**
     * get all gender 
     * @return type
     */
    public function GetAllGender() {
        $query = "select tbgender.idgender,tbgender.namegender from tbgender";
        $result = $this->exeQuery($query);
        $genderArray = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentGender = new Gender(
                    $row['idgender'], $row['namegender']);
            array_push($genderArray, $currentGender);
        }
        return $genderArray;
    }

}
