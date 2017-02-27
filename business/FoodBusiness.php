<?php

include '../data/FoodData.php';

/**
 * Description of FoodBusiness
 *
 * @author luisd
 */
class FoodBusiness {

     private $foodData;

    public function __construct() {
        $this->foodData = new FoodData();
    }

    /**
     * Used to insert a new food
     * @param type $food
     * @return type
     */
    public function insertFood($food) {
        return $this->foodData->insertFood($food);
    }

    /**
     * Update food data
     * @param type $food food to keep data
     * @return type query result
     */
    public function updateFood($food) {
        return $this->foodData->updateFood($food);
    }

    /**
     * Used to delete a food
     * @param type $id pk of the food to delete
     * @return type
     */
    public function deleteFood($id) {
        return $this->foodData->deleteFood($id);
    }
    /**
     * Use to get all food
     * @return type
     */
    public function getAllFood() {
        return $this->foodData->getAllFood();
    }
}
