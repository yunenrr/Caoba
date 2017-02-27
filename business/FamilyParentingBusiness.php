<?php

include '../data/FamilyParentingData.php';

/**
 * Description of FamilyParentingBusiness
 *
 * @author Karen
 */
class FamilyParentingBusiness {

    private $familyParentingData;

    function __construct() {
        return $this->familyParentingData = new FamilyParentingData();
    }

    /**
     * Used to insert a new FamilyParenting
     * @param type $familyParenting
     * @return type
     */
    public function insertFamilyParenting($familyParenting) {
        return $this->familyParentingData->insertFamilyParenting($familyParenting);
    }

    /**
     * Update FamilyParenting data
     * @param type $familyParenting user to keep data
     * @return type query result
     */
    public function updateFamilyParenting($familyParenting) {
        return $this->familyParentingData->updateFamilyParenting($familyParenting);
    }

    /**
     * Used to delete a FamilyParenting
     * @param type $id pk of the user to delete
     * @return type
     */
    public function deleteFamilyParenting($id) {
        return $this->familyParentingData->deleteFamilyParenting($id);
    }

    /**
     * Use to get the max id num to the FamilyParenting registration
     * @return type
     */
    public function getMaxId() {
        return $this->familyParentingData->getMaxId();
    }

    /**
     * use to get all RelationShip
     * @param type $idPerson
     * @return type
     */
    public function getAllRelationShip() {
        return $this->familyParentingData->getAllRelationShip();
    }

    /**
     * use to get a specif RelationShip
     * @param type $idPerson
     * @return type
     */
    public function getFamilyParenty($idPerson) {
        return $this->familyParentingData->getFamilyParenty($idPerson);
    }

    /**
     * Use to Check if are already family
     * @param type $idPerson
     * @return type
     */
    public function verifyFamily($idPerson, $idPersonFamilyParenting) {
        return $this->familyParentingData->verifyFamily($idPerson, $idPersonFamilyParenting);
    }

    /**
     * use to get a specif RelationShip tree
     * @param type $idPerson
     * @return type
     */
    public function getFamily($idPerson) {
        return $this->familyParentingData->getFamily($idPerson);
    }

    /**
     * Use to Check if are already family
     * @param type $id
     * @return type
     */
    public function verifyFamilyParents($id, $idPersonFamilyParenting) {
        return $this->familyParentingData->verifyFamilyParents($id, $idPersonFamilyParenting);
    }

}
