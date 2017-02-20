<?php

include '../data/MeasurementData.php';

/**
 * Description of MeasurementBusiness
 *
 * @author luisd
 */
class MeasurementBusiness {

    private $measurementData;

    public function MeasurementBusiness() {
        $this->measurementData = new MeasurementData();
    }

    public function getMeasurementByClientId($id) {
        return $this->measurementData->getMeasurementByClientId($id);
    }

    public function getMeasurementByClientIdForGraph($id) {
        return $this->measurementData->getMeasurementByClientIdForGraph($id);
    }

    /**
     * Used to insert a new measurement
     * @param type $measurement
     * @return type
     */
    public function insertMeasurement($measurement) {
        return $this->measurementData->insertMeasurement($measurement);
    }

    public function returnMeasurementQuantity($id) {
        return $this->measurementData->returnMeasurementQuantity($id);
    }

    /**
     * Update measurement data
     * @param type $measurement measurement to keep data
     * @return type query result
     */
    public function updateMeasurement($measurement) {
        return $this->measurementData->updateMeasurement($measurement);
    }

    /**
     * Used to delete a measurement
     * @param type $id pk of the measurement to delete
     * @return type
     */
    public function deleteMeasurement($id) {
        return $this->measurementData->deleteMeasurement($id);
    }

}
