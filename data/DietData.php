<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Diet.php';

/**
 * Se hace herencia de la clase "Connector", para poder realizar 
 *
 * @author luisd
 */
class DietData extends Connector {

    /**
     * Used to insert a new diet
     * @param type $diet
     * @return type
     */
    public function insertDiet($diet) {
        $query = "INSERT INTO TBDiet(idDiet,nameDiet,descriptionDiet)"
                . "VALUES ('" . $diet->getIdDiet() . "'"
                . ",'" . $diet->getNameDiet() . "'"
                . ",'" . $diet->getDescriptionDiet() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Update diet values
     * @param type $diet
     * @return type
     */
    public function updateDiet($diet) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    /**
     * Delete a diet by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deleteDiet($id) {
       //revisar llaves foraeas porque no elimina en cascada
        $query = 'DELETE FROM tbdiet WHERE iddiet=' . $id;
        $this->exeQuery($query);
        $query = 'DELETE FROM tbdietperson WHERE iddietdietperson=' . $id;
        $this->exeQuery($query);
        $query = 'DELETE FROM tbdietplan WHERE iddietdietplan=' . $id;
        if ($this->exeQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Use to get the max id num to the diet registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("Diet");
    }

    /**
     * Use to get all diet
     * @return array
     */
    public function getDiet($idPerson) {
        error_reporting(0);
        $query = "select iddiet,namediet,descriptiondiet from tbdiet inner join tbdietperson on iddiet = iddietdietperson inner join tbperson on idpersondietperson=idperson where idperson =" . $idPerson . "";
        $result = $this->exeQuery($query);
        $dietArray = array();
        while ($row = mysqli_fetch_array($result)) {
            $result2 = $this->getFood($row['iddiet']);
            $array = array(
                "iddiet" => $row['iddiet'],
                "namediet" => $row['namediet'],
                "descriptiondiet" => $row['descriptiondiet'],
                "days" => $result2
            );
//            echo "<br/>";
            array_push($dietArray, $array);
        }
//        exit;
        return $dietArray;
    }

    public function getFood($idDiet) {
        $query = "select dietdaydietplan,diethourdietplan,namefood from tbdiet inner join tbdietplan on iddiet = iddietdietplan inner join tbfood on idfooddietplan = idfood where iddiet =" . $idDiet . "";
//        echo $query;
        $result = $this->exeQuery($query);
        $dietArray = array();
        while ($row = mysqli_fetch_array($result)) {
//            $foodArray = $this->getFood($row['iddiet']);
            $array = array(
                "dietdaydietplan" => $row['dietdaydietplan'],
                "diethourdietplan" => $row['diethourdietplan'],
                "food" => $row['namefood'],
            );
            array_push($dietArray, $array);
        }
        return $dietArray;
    }

}
