<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';

//include '../domain/Condition.php';

class ConditionData extends Connector {

    public function insertClientCondition($idclient, $idcondition) {
        $id = $this->getMaxId("clinicaldetailperson");
        $query = "insert into tbclinicaldetailperson values(" . $id . "," . $idclient . "," . $idcondition . ");";
        return $this->exeQuery($query);
    }

    public function insertCondition($name, $risk) {
        $id = $this->getMaxId("condition");
        $query = "insert into tbcondition values(" . $id . ",\"" . $name . "\"," . $risk . ");";
        return $this->exeQuery($query);
    }

    public function deleteCondition($id) {
        $query = "delete from tbclinicaldetailperson where idcondictionclinicaldetailperson=" . $id;
        $this->exeQuery($query);
        $query = "delete from tbcondition where idcondition=" . $id;
        if ($this->exeQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteClientCondition($id, $condition) {
        $query = "delete from tbclinicaldetailperson where idpersonclinicaldetailperson=" . $id . " and idcondictionclinicaldetailperson=" . $condition;
        if ($this->exeQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getMaxId($name) {
        return $this->getMaxIdTable($name);
    }

    public function getAllCondition() {
        error_reporting(0);
        $query = "select * from tbcondition";
        $result = $this->exeQuery($query);
        $conditionArray = array();
        while ($row = mysqli_fetch_array($result)) {
            $array = array(
                "idcondition" => $row['idcondition'],
                "namecondition" => $row['namecondition'],
                "risklevelcondition" => $row['risklevelcondition']
            );
            array_push($conditionArray, $array);
        }

        return $conditionArray;
    }

    public function getClientCondition($id) {
        error_reporting(0);
        $query = "select idcondition,namecondition,risklevelcondition from tbcondition inner join tbclinicaldetailperson  on idcondition = idcondictionclinicaldetailperson inner join tbperson on idpersonclinicaldetailperson = idperson where idperson=" . $id;
        $result = $this->exeQuery($query);
        $conditionArray = array();
        while ($row = mysqli_fetch_array($result)) {
            $array = array(
                "idcondition" => $row['idcondition'],
                "namecondition" => $row['namecondition'],
                "risklevelcondition" => $row['risklevelcondition']
            );
            array_push($conditionArray, $array);
        }
        return $conditionArray;
    }

}
