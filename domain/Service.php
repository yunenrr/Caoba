<?php

/**
 * Description of Service
 *
 * @author Luis Castillo
 * @author Yunen Ramos Ramírez
 * @version 1.3
 */
class Service 
{
    //Atributos globales
    private $idService, $idInstructorService, $quotaService; //Int
    private $nameService, $descriptionService; //String
    private $startDateService, $endDateService; //Date

    /**
     * Función constructora.
     * @param int $idService Corresponde al identificador del servicio.
     * @param int $idInstructorService Corresponde al identificador del instructor.
     * @param String $nameService Corresponde al nombre del servicio.
     * @param String $descriptionService Corresponde a una breve descripción del servicio.
     * @param int $quotaService Corresponde al cupo del servicio.
     * @param date $startDateService Corresponde a la fecha de inicio del servicio.
     * @param data $endDateService Corresponde a la fecha de fin del servicio.
     */
    function Service($idService, $idInstructorService, $nameService, 
            $descriptionService, $quotaService,$startDateService,
            $endDateService) 
    {
        $this->idService = $idService;
        $this->idInstructorService = $idInstructorService;
        $this->nameService = $nameService;
        $this->descriptionService = $descriptionService;
        $this->quotaService = $quotaService;
        $this->startDateService = $startDateService;
        $this->endDateService = $endDateService;
    }//Fin de la función constructora

    /**************************** Funciones Get *******************************/
    function getIdService() {
        return $this->idService;
    }

    function getIdInstructorService() {
        return $this->idInstructorService;
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

    function getStartDateService() {
        return $this->startDateService;
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

    function setQuotaService($quotaService) {
        $this->quotaService = $quotaService;
    }

    function setNameService($nameService) {
        $this->nameService = $nameService;
    }

    function setDescriptionService($descriptionService) {
        $this->descriptionService = $descriptionService;
    }

    function setStartDateService($startDateService) {
        $this->startDateService = $startDateService;
    }

    function setEndDateService($endDateService) {
        $this->endDateService = $endDateService;
    }
}//Fin de la clase