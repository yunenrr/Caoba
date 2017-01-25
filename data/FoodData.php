<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Food.php';

/**
 * Description of FoodData
 *
 * @author luisd
 */
class FoodData extends Connector {

    /**
     * Used to insert a new food
     * @param type $food
     * @return type
     */
    public function insertFood($food) {
        $query = "";

        return $this->exeQuery($query);
    }

    /**
     * Update food values
     * @param type $food
     * @return type
     */
    public function updateFood($food) {

        //Aqui va la carne para actualizar

        return $this->exeQuery($query);
    }

    public function deleteFood($id) {
        if ($this->exeQuery("")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Use to get all food
     * @return array
     */
    public function getAllFood() {

        $query = "SELECT idFood,nameFood,nutritionalValueFood FROM TBFood";
        $result = $this->exeQuery($query);
        $array = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $current = new Food($row['idFood'], $row['nameFood'], $row['nutritionalValueFood']);
                array_push($array, $current);
                $current->getNameFood();
            }
        }
        return $array;
    }

}
