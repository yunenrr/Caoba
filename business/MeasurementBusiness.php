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

    /**
     * Used to insert a new measurement
     * @param type $measurement
     * @return type
     */
    public function insertMeasurement($measurement) {
        $this->measurementData->insertMeasurement($measurement);
    }

    /**
     * Update measurement data
     * @param type $measurement measurement to keep data
     * @return type query result
     */
    public function updateMeasurement($measurement) {
        $this->measurementData->updateMeasurement($measurement);
    }

    /**
     * Used to delete a measurement
     * @param type $id pk of the measurement to delete
     * @return type
     */
    public function deleteMeasurement($id) {
        $this->measurementData->deleteMeasurement($id);
    }

}
