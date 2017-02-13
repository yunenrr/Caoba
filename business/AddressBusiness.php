<?php

include '../data/AddressData.php';

/**
 * Description of AddressBussiness
 *
 * @author Karen
 */
class AddressBussiness {

    private $addressData;

    public function AddressBussiness() {
        return $this->addressData = new AddressData();
    }

    /**
     * Used to show all address
     * @return type
     */
    public function getAllAddress() {
        return $this->addressData->getAllAddress();
    }

    /**
     * Used to insert a new address
     * @param type $address
     * @return type
     */
    public function insertAddress($address) {
        return $this->addressData->insertaddress($address);
    }

    /**
     * Used to update a new address
     * @param type $adddress
     * @return type
     */
    public function updateAddress($adddress) {
        return $this->addressData->updateAddress($adddress);
    }

    /**
     * Used to delete a  address
     * @param type $idAddress
     * @return type
     */
    public function deleteAddress($idAddress) {
        return $this->addressData->deleteAddress($idAddress);
    }

    /**
     * Use to get the max id num to the address registration
     * @return type
     */
    public function getMaxId() {
        return $this->addressData->getMaxId();
    }

}
