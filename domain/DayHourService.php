<?php

/**
 * Objeto DayHourService
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class DayHourService
{
    // Declaración de variables globales
    private $idDayHourService,$dayService,$hourStartService,$hourEndService;
    
    /**
     * Función constructora.
     * @param int $idDayHourService Corresponde al identificador del objeto.
     * @param int $dayService Corresponde al identificador del día.
     * @param int $hourStartService Corresponde al identificador de la hora de inicio.
     * @param int $hourEndService Corresponde al identificador de la hora de finalización.
     */
    function DayHourService($idDayHourService, $dayService, $hourStartService, $hourEndService) 
    {
        $this->idDayHourService = $idDayHourService;
        $this->dayService = $dayService;
        $this->hourStartService = $hourStartService;
        $this->hourEndService = $hourEndService;
    }//Fin de la función constructora

    function getIdDayHourService() {
        return $this->idDayHourService;
    }

    function getDayService() {
        return $this->dayService;
    }

    function getHourStartService() {
        return $this->hourStartService;
    }

    function getHourEndService() {
        return $this->hourEndService;
    }

    function setIdDayHourService($idDayHourService) {
        $this->idDayHourService = $idDayHourService;
    }

    function setDayService($dayService) {
        $this->dayService = $dayService;
    }

    function setHourStartService($hourStartService) {
        $this->hourStartService = $hourStartService;
    }

    function setHourEndService($hourEndService) {
        $this->hourEndService = $hourEndService;
    }


}//Fin de la clase