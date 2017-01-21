<?php

/**
 * Description of Service
 *
 * @author Luis Castillo
 * @author Yunen Ramos Ramírez
 * @version 1.2
 */
class Service 
{
    //Atributos globales
    private $idService, $idInstructorService, $priceService, $quotaService; //Int
    private $nameService, $descriptionService; //String
    private $starDateService, $endDateService; //Date

    /**
     * Función constructora.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idInstructorService Corresponde al identificador del instructor.
     * @param String $nameService Corresponde al nombre del servicio.
     * @param String $descriptionService Corresponde a una breve descripción del servicio.
     * @param int $priceService Corresponde al precio del servicio.
     * @param int $quotaService Corresponde al cupo del servicio.
     * @param date $starDateService Corresponde a la fecha de inicio del servicio.
     * @param data $endDateService Corresponde a la fecha de fin del servicio.
     */
    function Service($idService, $idInstructorService, $nameService, 
            $descriptionService, $priceService, $quotaService,$starDateService,
            $endDateService) 
    {
        $this->idService = $idService;
        $this->idInstructorService = $idInstructorService;
        $this->nameService = $nameService;
        $this->descriptionService = $descriptionService;
        $this->priceService = $priceService;
        $this->quotaService = $quotaService;
        $this->starDateService = $starDateService;
        $this->endDateService = $endDateService;
    }//Fin de la función constructora

    /**************************** Funciones Get *******************************/
    function getIdService() {
        return $this->idService;
    }

    function getIdInstructorService() {
        return $this->idInstructorService;
    }

    function getPriceService() {
        return $this->priceService;
    }

    function getQuotaService() {
        return $this->quotaService;
    }

    function getNameService() {
        return $this->nameService;
    }

    function getDescriptionService() {
        return $this->descriptionService;
    }

    function getStarDateService() {
        return $this->starDateService;
    }

    function getEndDateService() {
        return $this->endDateService;
    }

    /**************************** Funciones Set *******************************/
    function setIdService($idService) {
        $this->idService = $idService;
    }

    function setIdInstructorService($idInstructorService) {
        $this->idInstructorService = $idInstructorService;
    }

    function setPriceService($priceService) {
        $this->priceService = $priceService;
    }

    function setQuotaService($quotaService) {
        $this->quotaService = $quotaService;
    }

    function setNameService($nameService) {
        $this->nameService = $nameService;
    }

    function setDescriptionService($descriptionService) {
        $this->descriptionService = $descriptionService;
    }

    function setStarDateService($starDateService) {
        $this->starDateService = $starDateService;
    }

    function setEndDateService($endDateService) {
        $this->endDateService = $endDateService;
    }
}//Fin de la clase