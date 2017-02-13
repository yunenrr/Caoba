<?php

/**
 * Clase objeto de tipo horario/servicio
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class ScheduleService
{
    //Declaración de variables
    private $idScheduleService,$idcampusScheduleService,
            $idserviceScheduleService,$dayScheduleService,
            $hourScheduleService;
    private $dateScheduleService;
    
    /**
     * Función constructora.
     * @param int $idScheduleService Identificador del .
     * @param int $idcampusScheduleService Identificador del campus.
     * @param int $idserviceScheduleService Identificador del servicio.
     * @param int $dayScheduleService Identificador del día.
     * @param int $hourScheduleService Identificador de la hora.
     * @param date $dateScheduleService Corresponde a la fecha.
     */
    function ScheduleService($idScheduleService, $idcampusScheduleService,
            $idserviceScheduleService, $dayScheduleService, $hourScheduleService, 
            $dateScheduleService) 
    {
        $this->idScheduleService = $idScheduleService;
        $this->idcampusScheduleService = $idcampusScheduleService;
        $this->idserviceScheduleService = $idserviceScheduleService;
        $this->dayScheduleService = $dayScheduleService;
        $this->hourScheduleService = $hourScheduleService;
        $this->dateScheduleService = $dateScheduleService;
    }//Fin del método
    
    function getIdScheduleService() {
        return $this->idScheduleService;
    }

    function getIdcampusScheduleService() {
        return $this->idcampusScheduleService;
    }

    function getIdserviceScheduleService() {
        return $this->idserviceScheduleService;
    }

    function getDayScheduleService() {
        return $this->dayScheduleService;
    }

    function getHourScheduleService() {
        return $this->hourScheduleService;
    }

    function getDateScheduleService() {
        return $this->dateScheduleService;
    }

    function setIdScheduleService($idScheduleService) {
        $this->idScheduleService = $idScheduleService;
    }

    function setIdcampusScheduleService($idcampusScheduleService) {
        $this->idcampusScheduleService = $idcampusScheduleService;
    }

    function setIdserviceScheduleService($idserviceScheduleService) {
        $this->idserviceScheduleService = $idserviceScheduleService;
    }

    function setDayScheduleService($dayScheduleService) {
        $this->dayScheduleService = $dayScheduleService;
    }

    function setHourScheduleService($hourScheduleService) {
        $this->hourScheduleService = $hourScheduleService;
    }

    function setDateScheduleService($dateScheduleService) {
        $this->dateScheduleService = $dateScheduleService;
    }

}//Fin de la clase ScheduleService