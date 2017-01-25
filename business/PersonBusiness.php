<?php

include '../data/PersonData.php';

/**
 * Description of PersonBusiness
 *
 * @author Luis
 */
class PersonBusiness {

    private $personData;

    public function PersonBusiness() {
        return $this->personData = new PersonData();
    }

    /**
     * Use to get all people
     * @param type $name Description
     * @return type
     */
    public function getAllPersons() {
        return $this->personData->getAllPersons();
    }

    /**
     * use to get a specif person
     * @param type $id
     * @return type
     */
    public function getPerson($id) {
        return $this->personData->getPerson($id);
    }
    public function getPersonByDNI($id) {
        return $this->personData->getPersonByDNI($id);
    }

    /**
     * Use to get the max id num to the people registration
     * @return type
     */
    public function getMaxId() {
        return $this->personData->getMaxId();
    }

    /**
     * Use to verify if the dni already exist
     * @param type $dni
     * @return type
     */
    public function verifyDniPerson($dni) {
        return $this->personData->verifyDniPerson($dni);
    }

    /**
     * Used to insert a new person
     * @param type $person
     * @return type
     */
    public function insertPerson($person) {
        return $this->personData->insertPerson($person);
    }

    /**
     * Update person data
     * @param type $person person to keep data
     * @return type query result
     */
    public function updatePerson($person) {
        return $this->personData->updatePerson($person);
    }

    /**
     * Used to delete a person
     * @param type $id pk of the person to delete
     * @return type
     */
    public function deletePerson($id) {
        return $this->personData->deletePerson($id);
    }

    /**
     * Used to delete a person
     * @param type $typeUser pk of the person to delete
     * @return type
     */
    public function returnPersonsByTypeBusiness($typeUser) {
        return $this->personData->returnPersonsByTypeData($typeUser);
    }
/**
     * use to get all gender 
     * @return type
     */
    public function GetAllGender(){
         return $this->personData->GetAllGender(); 
    }
    
}
