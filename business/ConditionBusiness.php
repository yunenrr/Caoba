<?php

include '../data/ConditionData.php';

class ConditionBusiness {

    private $conditionData;

    public function __construct() {
        return $this->conditionData = new ConditionData();
    }

    public function insertCondition($name, $risk) {
        return $this->conditionData->insertCondition($name, $risk);
    }

    public function insertClientCondition($idclient, $idcondition) {
        return $this->conditionData->insertClientCondition($idclient, $idcondition);
    }

    public function updateCondition($condition) {
        return $this->conditionData->updateCondition($condition);
    }

    public function deleteCondition($id) {
        return $this->conditionData->deleteCondition($id);
    }

    public function deleteClientCondition($id, $condition) {
        return $this->conditionData->deleteClientCondition($id, $condition);
    }

    public function getMaxId() {
        return $this->conditionData->getMaxId();
    }

    public function getAllCondition() {
        return $this->conditionData->getAllCondition();
    }

    public function getClientCondition($id) {
        return $this->conditionData->getClientCondition($id);
    }

}
