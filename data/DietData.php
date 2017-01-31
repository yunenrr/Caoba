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
        $query = 'DELETE FROM TBDiet WHERE idDiet=' . $id;
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

        $query = "select distinct  iddiet, namediet, descriptiondiet,dietdaydietplan,diethourdietplan,namefood, "
                . "group_concat(namefood separator '-') as list_food  "
                . "from tbdiet inner join tbdietperson on iddiet = iddietdietperson "
                . "inner join tbdietplan on iddiet= iddietdietplan "
                . "inner join tbfood on idfooddietplan=idfood "
                . "where idpersondietperson
 ='".$idPerson."' GROUP BY iddiet;";

        $result = $this->exeQuery($query);
        $temp = "";
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
               $temp  = $temp. $row['iddiet'] . "," . $row['list_food'] . "," . $row['namediet'] . "," .
                        $row['descriptiondiet'] . "," . $row['dietdaydietplan'] . "," . $row['diethourdietplan'] . ";";
            }
        }

        return $temp;
    }

}
