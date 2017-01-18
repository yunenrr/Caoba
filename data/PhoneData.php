<?php

header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Phone.php';

/**
 * Description of PhoneData
 *
 * @author luisd
 */
class PhoneData extends Connector {

    /**
     * Used to insert a new phone
     * @param type $phone
     * @return type
     */
    public function insertPhone($phone) {
        $query = "INSERT INTO TBPhone (idPhone ,idClientPhone ,numberPhone)
        VALUES ('" . $phone->getIdPhone() . "' , '" . $phone->getIdClientPhone() . "', '" . $phone->getNumberPhone() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Update phone values
     * @param type $phone
     * @return type
     */
    public function updatePhone($phone) {

        $query = "UPDATE TBPhone SET numberPhone= " . $phone->getNumberPhone() . " "
                . "WHERE  idPhone='" . $phone->getIdPhone() . "'";

        return $this->exeQuery($query);
    }

    /**
     * Delete a phone by id
     * @param type $id pk of the element to delete
     * @return type
     */
    public function deletePhone($id) {
        if ($this->exeQuery("DELETE FROM TBPhone WHERE idPhone = " . $id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Use to get the max id num to the phone registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("Phone");
    }

    public function getAllPhonesPerson($idPerson) {
        $query = "SELECT * FROM TBPhone WHERE idClientPhone = " . $idPerson;
        $allPhoneResult = $this->exeQuery($query);
        $array = [];
        while ($row = mysqli_fetch_array($allPhoneResult)) {
            $currentPhone = new Phone($row['idPhone'], $row['idClientPhone'], $row['numberPhone']);
            array_push($array, $currentPhone);
        }
        return $array;
    }

}
