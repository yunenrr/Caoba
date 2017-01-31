<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/DietPerson.php';

/**
 * Description of DietPersonData
 *
 * @author Karen
 */
class DietPersonData extends Connector {

    /**
     * Used to insert a new dietperson
     * @param type $Dietperson
     * @return type
     */
    public function insertDietPerson($Dietperson) {

        $query = "insert into tbdietperson(iddietperson,idpersondietperson,iddietdietperson) "
                . "VALUES ('" . $Dietperson->getIdDietPerson() . "'"
                . ", '" . $Dietperson->getIdPersonDietPerson() . "'"
                . ",'" . $Dietperson->getIdDietDietPerson() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Use to get the max id num to the dietperson registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("dietperson");
    }

}
