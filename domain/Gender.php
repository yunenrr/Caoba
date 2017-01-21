<?php

/**
 * Objeto Género
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class Gender 
{
    //Declaración de variables globales
    private $idGender;
    private $nameGender;
    
    /**
     * Función constructora.
     * @param int $idGender Corresponde a un identificador del género.
     * @param String $nameGender Corresponde al nombre del género.
     */
    function Gender($idGender, $nameGender) 
    {
        $this->idGender = $idGender;
        $this->nameGender = $nameGender;
    }//Fin de la ufnción

    function getIdGender() {
        return $this->idGender;
    }

    function getNameGender() {
        return $this->nameGender;
    }

    function setIdGender($idGender) {
        $this->idGender = $idGender;
    }

    function setNameGender($nameGender) {
        $this->nameGender = $nameGender;
    }
}//Fin de la clase