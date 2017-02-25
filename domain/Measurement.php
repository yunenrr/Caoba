<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Measurement
 *
 * @author luisd
 */
class Measurement {

    private $idMeasurement;
    private $idPersonMeasurement;
    private $measurementDateMeasurement;
    private $transverseThoraxMeasurement;
    private $backThoraxMeasurement;
    private $biiliocrestideoMeasurement;
    private $humeralMeasurement;
    private $femoralMeasurement;
    private $headMeasurement;
    private $armRelaxedMeasurement;
    private $armFlexedMeasurement;
    private $forearmMeasurement;
    private $mesosternalThoraxMeasurement;
    private $waistMeasurement;
    private $hipMeasurement;
    private $innerThighMeasurement;
    private $upperThighMeasurement;
    private $calfMaxMeasurement;
    private $tricepsMeasurement;
    private $subscapularMeasurement;
    private $supraspiralMeasurement;
    private $abdominalMeasurement;
    private $medialThighMeasurement;
    private $calfMeasurement;
    private $muscleMassMeasurement;
    private $weightMeasurement;
    private $totalFatMeasurement;
    private $heightMeasurement;

    function Measurement($idMeasurement, $idPersonMeasurement, $measurementDateMeasurement, $transverseThoraxMeasurement, $backThoraxMeasurement, $biiliocrestideoMeasurement, $humeralMeasurement, $femoralMeasurement, $headMeasurement, $armRelaxedMeasurement, $armFlexedMeasurement, $forearmMeasurement, $mesosternalThoraxMeasurement, $waistMeasurement, $hipMeasurement, $innerThighMeasurement, $upperThighMeasurement, $calfMaxMeasurement, $tricepsMeasurement, $subscapularMeasurement, $supraspiralMeasurement, $abdominalMeasurement, $medialThighMeasurement, $calfMeasurement, $muscleMassMeasurement, $weightMeasurement, $totalFatMeasurement, $heightMeasurement) {
        $this->idMeasurement = $idMeasurement;
        $this->idPersonMeasurement = $idPersonMeasurement;
        $this->measurementDateMeasurement = $measurementDateMeasurement;
        $this->transverseThoraxMeasurement = $transverseThoraxMeasurement;
        $this->backThoraxMeasurement = $backThoraxMeasurement;
        $this->biiliocrestideoMeasurement = $biiliocrestideoMeasurement;
        $this->humeralMeasurement = $humeralMeasurement;
        $this->femoralMeasurement = $femoralMeasurement;
        $this->headMeasurement = $headMeasurement;
        $this->armRelaxedMeasurement = $armRelaxedMeasurement;
        $this->armFlexedMeasurement = $armFlexedMeasurement;
        $this->forearmMeasurement = $forearmMeasurement;
        $this->mesosternalThoraxMeasurement = $mesosternalThoraxMeasurement;
        $this->waistMeasurement = $waistMeasurement;
        $this->hipMeasurement = $hipMeasurement;
        $this->innerThighMeasurement = $innerThighMeasurement;
        $this->upperThighMeasurement = $upperThighMeasurement;
        $this->calfMaxMeasurement = $calfMaxMeasurement;
        $this->tricepsMeasurement = $tricepsMeasurement;
        $this->subscapularMeasurement = $subscapularMeasurement;
        $this->supraspiralMeasurement = $supraspiralMeasurement;
        $this->abdominalMeasurement = $abdominalMeasurement;
        $this->medialThighMeasurement = $medialThighMeasurement;
        $this->calfMeasurement = $calfMeasurement;
        $this->muscleMassMeasurement = $muscleMassMeasurement;
        $this->weightMeasurement = $weightMeasurement;
        $this->totalFatMeasurement = $totalFatMeasurement;
        $this->heightMeasurement = $heightMeasurement;
    }

    function getIdMeasurement() {
        return $this->idMeasurement;
    }

    function getIdPersonMeasurement() {
        return $this->idPersonMeasurement;
    }

    function getMeasurementDateMeasurement() {
        return $this->measurementDateMeasurement;
    }

    function getTransverseThoraxMeasurement() {
        return $this->transverseThoraxMeasurement;
    }

    function getBackThoraxMeasurement() {
        return $this->backThoraxMeasurement;
    }

    function getBiiliocrestideoMeasurement() {
        return $this->biiliocrestideoMeasurement;
    }

    function getHumeralMeasurement() {
        return $this->humeralMeasurement;
    }

    function getFemoralMeasurement() {
        return $this->femoralMeasurement;
    }

    function getHeadMeasurement() {
        return $this->headMeasurement;
    }

    function getArmRelaxedMeasurement() {
        return $this->armRelaxedMeasurement;
    }

    function getArmFlexedMeasurement() {
        return $this->armFlexedMeasurement;
    }

    function getForearmMeasurement() {
        return $this->forearmMeasurement;
    }

    function getMesosternalThoraxMeasurement() {
        return $this->mesosternalThoraxMeasurement;
    }

    function getWaistMeasurement() {
        return $this->waistMeasurement;
    }

    function getHipMeasurement() {
        return $this->hipMeasurement;
    }

    function getInnerThighMeasurement() {
        return $this->innerThighMeasurement;
    }

    function getUpperThighMeasurement() {
        return $this->upperThighMeasurement;
    }

    function getCalfMaxMeasurement() {
        return $this->calfMaxMeasurement;
    }

    function getTricepsMeasurement() {
        return $this->tricepsMeasurement;
    }

    function getSubscapularMeasurement() {
        return $this->subscapularMeasurement;
    }

    function getSupraspiralMeasurement() {
        return $this->supraspiralMeasurement;
    }

    function getAbdominalMeasurement() {
        return $this->abdominalMeasurement;
    }

    function getMedialThighMeasurement() {
        return $this->medialThighMeasurement;
    }

    function getCalfMeasurement() {
        return $this->calfMeasurement;
    }

    function getMuscleMassMeasurement() {
        return $this->muscleMassMeasurement;
    }

    function getWeightMeasurement() {
        return $this->weightMeasurement;
    }

    function getTotalFatMeasurement() {
        return $this->totalFatMeasurement;
    }

    function getHeightMeasurement() {
        return $this->heightMeasurement;
    }

    function setIdMeasurement($idMeasurement) {
        $this->idMeasurement = $idMeasurement;
    }

    function setIdPersonMeasurement($idPersonMeasurement) {
        $this->idPersonMeasurement = $idPersonMeasurement;
    }

    function setMeasurementDateMeasurement($measurementDateMeasurement) {
        $this->measurementDateMeasurement = $measurementDateMeasurement;
    }

    function setTransverseThoraxMeasurement($transverseThoraxMeasurement) {
        $this->transverseThoraxMeasurement = $transverseThoraxMeasurement;
    }

    function setBackThoraxMeasurement($backThoraxMeasurement) {
        $this->backThoraxMeasurement = $backThoraxMeasurement;
    }

    function setBiiliocrestideoMeasurement($biiliocrestideoMeasurement) {
        $this->biiliocrestideoMeasurement = $biiliocrestideoMeasurement;
    }

    function setHumeralMeasurement($humeralMeasurement) {
        $this->humeralMeasurement = $humeralMeasurement;
    }

    function setFemoralMeasurement($femoralMeasurement) {
        $this->femoralMeasurement = $femoralMeasurement;
    }

    function setHeadMeasurement($headMeasurement) {
        $this->headMeasurement = $headMeasurement;
    }

    function setArmRelaxedMeasurement($armRelaxedMeasurement) {
        $this->armRelaxedMeasurement = $armRelaxedMeasurement;
    }

    function setArmFlexedMeasurement($armFlexedMeasurement) {
        $this->armFlexedMeasurement = $armFlexedMeasurement;
    }

    function setForearmMeasurement($forearmMeasurement) {
        $this->forearmMeasurement = $forearmMeasurement;
    }

    function setMesosternalThoraxMeasurement($mesosternalThoraxMeasurement) {
        $this->mesosternalThoraxMeasurement = $mesosternalThoraxMeasurement;
    }

    function setWaistMeasurement($waistMeasurement) {
        $this->waistMeasurement = $waistMeasurement;
    }

    function setHipMeasurement($hipMeasurement) {
        $this->hipMeasurement = $hipMeasurement;
    }

    function setInnerThighMeasurement($innerThighMeasurement) {
        $this->innerThighMeasurement = $innerThighMeasurement;
    }

    function setUpperThighMeasurement($upperThighMeasurement) {
        $this->upperThighMeasurement = $upperThighMeasurement;
    }

    function setCalfMaxMeasurement($calfMaxMeasurement) {
        $this->calfMaxMeasurement = $calfMaxMeasurement;
    }

    function setTricepsMeasurement($tricepsMeasurement) {
        $this->tricepsMeasurement = $tricepsMeasurement;
    }

    function setSubscapularMeasurement($subscapularMeasurement) {
        $this->subscapularMeasurement = $subscapularMeasurement;
    }

    function setSupraspiralMeasurement($supraspiralMeasurement) {
        $this->supraspiralMeasurement = $supraspiralMeasurement;
    }

    function setAbdominalMeasurement($abdominalMeasurement) {
        $this->abdominalMeasurement = $abdominalMeasurement;
    }

    function setMedialThighMeasurement($medialThighMeasurement) {
        $this->medialThighMeasurement = $medialThighMeasurement;
    }

    function setCalfMeasurement($calfMeasurement) {
        $this->calfMeasurement = $calfMeasurement;
    }

    function setMuscleMassMeasurement($muscleMassMeasurement) {
        $this->muscleMassMeasurement = $muscleMassMeasurement;
    }

    function setWeightMeasurement($weightMeasurement) {
        $this->weightMeasurement = $weightMeasurement;
    }

    function setTotalFatMeasurement($totalFatMeasurement) {
        $this->totalFatMeasurement = $totalFatMeasurement;
    }

    function setHeightMeasurement($heightMeasurement) {
        $this->heightMeasurement = $heightMeasurement;
    }
}
