<?php

/**
 * Description of Service
 *
 * @author Luis Castillo
 * @author Yunen Ramos Ramírez
 * @version 1.1
 */
class Service {

    private $idService;
    private $idInstructorService;
    private $nameService;
    private $descriptionService;
    private $priceService;
    private $quotaService;

    /**
     * Función constructora.
     * @param int $id Corresponde al id del servicio
     * @param int $idInstructor Corresponde al id del instructor.
     * @param String $serviceName Corresponde al nombre del servicio.
     * @param String $description Una descripción sobre en qué consiste el servicio.
     * @param int $price Corresponde al precio del servicio.
     * @param int $quota Corresponde al cupo del servicio
     */
    function Service($idService, $idInstructorService, $nameService, $descriptionService, $priceService, $quotaService) {
        $this->idService = $idService;
        $this->idInstructorService = $idInstructorService;
        $this->nameService = $nameService;
        $this->descriptionService = $descriptionService;
        $this->priceService = $priceService;
        $this->quotaService = $quotaService;
    }

    function getIdService() {
        return $this->idService;
    }

    function getIdInstructorService() {
        return $this->idInstructorService;
    }

    function getNameService() {
        return $this->nameService;
    }

    function getDescriptionService() {
        return $this->descriptionService;
    }

    function getPriceService() {
        return $this->priceService;
    }

    function getQuotaService() {
        return $this->quotaService;
    }

    function setIdService($idService) {
        $this->idService = $idService;
    }

    function setIdInstructorService($idInstructorService) {
        $this->idInstructorService = $idInstructorService;
    }

    function setNameService($nameService) {
        $this->nameService = $nameService;
    }

    function setDescriptionService($descriptionService) {
        $this->descriptionService = $descriptionService;
    }

    function setPriceService($priceService) {
        $this->priceService = $priceService;
    }

    function setQuotaService($quotaService) {
        $this->quotaService = $quotaService;
    }

}//Fin de la clase