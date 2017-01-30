<?php

include '../data/ServiceData1.php';

/**
 * Description of ServiceBusiness1
 *
 * @author luisd
 */
class ServiceBusiness1 {

    private $serviceData;

    public function ServiceBusiness1() {
        return $this->serviceData = new ServiceData1();
    }

    public function insertServiceToClient($idClientRecord, $idPersonUserClientRecord, $idServicePaymentModuleClientRecord, $idRelationServiceScheduleClientRecord, $startDateClientRecord) {
        return $this->serviceData->insertServiceToClient($idClientRecord, $idPersonUserClientRecord, $idServicePaymentModuleClientRecord, $idRelationServiceScheduleClientRecord, $startDateClientRecord);
    }

    /**
     * Use to get the services
     * @return type
     */
    public function getAllService() {
        return $this->serviceData->getAllService();
    }

    /**
     * Use to get the services
     * @return type
     */
    public function getDayService($id) {
        return $this->serviceData->getDayService($id);
    }

    /**
     * Use to get the hour start
     * @return type
     */
    public function getHourStartService($id, $idDay) {
        return $this->serviceData->getHourStartService($id, $idDay);
    }

    /**
     * Use to get the hour end
     * @return type
     */
    public function getHourEndService($id) {
        return $this->serviceData->getHourEndService($id);
    }

    public function getCampusService($id) {
        return $this->serviceData->getCampusService($id);
    }

    public function getInstructorService($id) {
        return $this->serviceData->getInstructorService($id);
    }

    public function getPaymentModuleService($id) {
        return $this->serviceData->getPaymentModuleService($id);
    }

    public function getIdTbServicePaymentModule($idService, $idModule) {
        return $this->serviceData->getIdTbServicePaymentModule($idService, $idModule);
    }

    public function getIdRelationtServices($idService, $idRelation) {
        return $this->serviceData->getIdRelationtServices($idService, $idRelation);
    }

    public function getMaxId() {
        return $this->serviceData->getMaxId();
    }

}
