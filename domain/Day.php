<?php

/**
 * Objeto Día
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class Day 
{
    //Declaración de variables globales
    private $idDay,$nameDay;
    
    /**
     * Función constructora.
     * @param int $idDay Corresponde al identificador del día.
     * @param String $nameDay Corresponde al nombre del día.
     */
    function Day($idDay, $nameDay) 
    {
        $this->idDay = $idDay;
        $this->nameDay = $nameDay;
    }//Fin de la función constructora

    function getIdDay() {
        return $this->idDay;
    }

    function getNameDay() {
        return $this->nameDay;
    }

    function setIdDay($idDay) {
        $this->idDay = $idDay;
    }

    function setNameDay($nameDay) {
        $this->nameDay = $nameDay;
    }


}//Fin de la clase