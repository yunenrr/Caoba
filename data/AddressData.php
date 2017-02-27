<?php

//header("Content-Type: text/html;charset=utf-8");
require_once '../data/Connector.php';
include '../domain/Address.php';

/**
 * Description of AddressData
 *
 * @author Karen
 */
class AddressData extends Connector {

    /**
     * Show all address
     * @param type $address
     * @return type
     */
    public function getAllAddress() {
        $query = "SELECT idaddress,neighborhoodaddress from tbaddress;";
        $result = $this->exeQuery($query);
        $array = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $address = new Address($row['idaddress'], $row['neighborhoodaddress']);
                array_push($array, $address);
            }//Fin del while
        }//Fin del if
        return $array;
    }

    /**
     * Used to insert a new address
     * @param type $address
     * @return type
     */
    public function insertAddress($address) {
        $query = "INSERT INTO tbaddress(idaddress,neighborhoodaddress)"
                . "VALUES ('" . $address->getIdAddress() . "'"
                . ",'" . $address->getNeighborhoodAddresss() . "');";

        return $this->exeQuery($query);
    }

    /**
     * Update address values
     * @param type $address
     * @return type
     */
    public function updateAddress($address) {
        $query = "UPDATE tbaddress SET "
                . "neighborhoodaddress  = '" . $address->getNeighborhoodAddresss() . "'"
                . " WHERE idaddress = '" . $address->getIdAddress() . "'";
        return $this->exeQuery($query);
    }

    /**
     * Update address values
     * @param type $idAddress
     * @return type
     */
    public function deleteAddress($idAddress) {
        $query = 'DELETE FROM tbaddress WHERE idaddress=' . $idAddress;
        return $this->exeQuery($query);
    }

    /**
     * Use to get the max id num to the address registration
     * @return type
     */
    public function getMaxId() {
        return $this->getMaxIdTable("address");
    }

}
