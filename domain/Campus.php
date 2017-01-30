<?php

/**
 * Clase que nos permite administrar el objeto Campo
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class Campus 
{
    //Declaración de variables globales
    private $idCampus,$nameCampus;
    
    /**
     * Función constructora.
     * @param int $idCampus Corresponde al identificador del campo.
     * @param String $nameCampus Corresponde al nombre del campo.
     */
    function Campus($idCampus, $nameCampus) 
    {
        $this->idCampus = $idCampus;
        $this->nameCampus = $nameCampus;
    }//Fin de la función Constructora

    function getIdCampus() {
        return $this->idCampus;
    }

    function getNameCampus() {
        return $this->nameCampus;
    }

    function setIdCampus($idCampus) {
        $this->idCampus = $idCampus;
    }

    function setNameCampus($nameCampus) {
        $this->nameCampus = $nameCampus;
    }


}//Fin de la clase