<?php

/**
 * Description of FamilyParenting
 *
 * @author Karen
 */
class FamilyParenting {

//put your code here

    private $idFamilyParenting;
    private $idPersonFamilyParenting;
    private $idRelativeFamilyParenting;
    private $idRelationshipFamilyParenting;

    function FamilyParenting($idFamilyParenting, $idPersonFamilyParenting, $idRelativeFamilyParenting, $idRelationshipFamilyParenting) {

        $this->idFamilyParenting = $idFamilyParenting;
        $this->idPersonFamilyParenting = $idPersonFamilyParenting;
        $this->idRelativeFamilyParenting = $idRelativeFamilyParenting;
        $this->idRelationshipFamilyParenting = $idRelationshipFamilyParenting;
    }
    function getIdFamilyParenting() {
        return $this->idFamilyParenting;
    }

    function getIdPersonFamilyParenting() {
        return $this->idPersonFamilyParenting;
    }

    function getIdRelativeFamilyParenting() {
        return $this->idRelativeFamilyParenting;
    }

    function getIdRelationshipFamilyParenting() {
        return $this->idRelationshipFamilyParenting;
    }

    function setIdFamilyParenting($idFamilyParenting) {
        $this->idFamilyParenting = $idFamilyParenting;
    }

    function setIdPersonFamilyParenting($idPersonFamilyParenting) {
        $this->idPersonFamilyParenting = $idPersonFamilyParenting;
    }

    function setIdRelativeFamilyParenting($idRelativeFamilyParenting) {
        $this->idRelativeFamilyParenting = $idRelativeFamilyParenting;
    }

    function setIdRelationshipFamilyParenting($idRelationshipFamilyParenting) {
        $this->idRelationshipFamilyParenting = $idRelationshipFamilyParenting;
    }


}
