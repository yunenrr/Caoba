<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Person
 *
 * @author luisd
 */
class Person implements \JsonSerializable{

    private $idPerson;
    private $dniPerson;
    private $namePerson;
    private $firstNamePerson;
    private $secondNamePerson;
    private $agePerson;
    private $genderPerson;
    private $emailPerson;
    private $addressPerson;
    private $phoneReferencePerson;
    private $bloodTypePerson;

    function Person($idPerson, $dniPerson, $namePerson, $firstNamePerson, $secondNamePerson, $agePerson, $genderPerson, $emailPerson, $addressPerson, $phoneReferencePerson, $bloodTypePerson) {
        $this->idPerson = $idPerson;
        $this->dniPerson = $dniPerson;
        $this->namePerson = $namePerson;
        $this->firstNamePerson = $firstNamePerson;
        $this->secondNamePerson = $secondNamePerson;
        $this->agePerson = $agePerson;
        $this->genderPerson = $genderPerson;
        $this->emailPerson = $emailPerson;
        $this->addressPerson = $addressPerson;
        $this->emailPerson = $emailPerson;
        $this->addressPerson = $addressPerson;
        $this->phoneReferencePerson = $phoneReferencePerson;
        $this->bloodTypePerson = $bloodTypePerson;
    }

    function getIdPerson() {
        return $this->idPerson;
    }

    function getDniPerson() {
        return $this->dniPerson;
    }

    function getNamePerson() {
        return $this->namePerson;
    }

    function getFirstNamePerson() {
        return $this->firstNamePerson;
    }

    function getPhoneReferencePerson() {
        return $this->phoneReferencePerson;
    }

    function getBloodTypePerson() {
        return $this->bloodTypePerson;
    }

    function setPhoneReferencePerson($phoneReferencePerson) {
        $this->phoneReferencePerson = $phoneReferencePerson;
    }

    function setBloodTypePerson($bloodTypePerson) {
        $this->bloodTypePerson = $bloodTypePerson;
    }

    function getSecondNamePerson() {
        return $this->secondNamePerson;
    }

    function getAgePerson() {
        return $this->agePerson;
    }

    function getGenderPerson() {
        return $this->genderPerson;
    }

    function getEmailPerson() {
        return $this->emailPerson;
    }

    function getAddressPerson() {
        return $this->addressPerson;
    }

    function setIdPerson($idPerson) {
        $this->idPerson = $idPerson;
    }

    function setDniPerson($dniPerson) {
        $this->dniPerson = $dniPerson;
    }

    function setNamePerson($namePerson) {
        $this->namePerson = $namePerson;
    }

    function setFirstNamePerson($firstNamePerson) {
        $this->firstNamePerson = $firstNamePerson;
    }

    function setSecondNamePerson($secondNamePerson) {
        $this->secondNamePerson = $secondNamePerson;
    }

    function setAgePerson($agePerson) {
        $this->agePerson = $agePerson;
    }

    function setGenderPerson($genderPerson) {
        $this->genderPerson = $genderPerson;
    }

    function setEmailPerson($emailPerson) {
        $this->emailPerson = $emailPerson;
    }

    function setAddressPerson($addressPerson) {
        $this->addressPerson = $addressPerson;
    }

    public function jsonSerialize() {
        
    }

}

//Fin de la clase