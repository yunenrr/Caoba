<?php

include '../data/PhoneData.php';

/**
 * Description of PhoneBusiness
 *
 * @author luisd
 */
class PhoneBusiness {

     private $phoneData;

    public function __construct() {
        return $this->phoneData = new PhoneData();
    }

    /**
     * Used to insert a new phone
     * @param type $phone
     * @return type
     */
    public function insertPhone($phone) {
        return $this->phoneData->insertPhone($phone);
    }

    /**
     * Update phone data
     * @param type $phone phone to keep data
     * @return type query result
     */
    public function updatePhone($phone) {
        return $this->phoneData->updatePhone($phone);
    }

    /**
     * Used to delete a phone
     * @param type $id pk of the phone to delete
     * @return type
     */
    public function deletePhone($id) {
        return $this->phoneData->deletePhone($id);
    }
    
     /**
     * Use to get the max id num to the phones registration
     * @return type
     */
    public function getMaxId() {
        return $this->phoneData->getMaxId();
    }
    
    public function getAllPhonesPerson($idPerson) {
        return $this->phoneData->getAllPhonesPerson($idPerson);
    }
    
}
