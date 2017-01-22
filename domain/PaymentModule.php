<?php

/**
 * Objeto PaymentModule
 *
 * @author Yunen Ramos Ramírez
 * @version 1.0
 */
class PaymentModule 
{
    //Declaración de variables globales
    private $idPaymentModule,$namePaymentModule;
    
    /**
     * Función constructora.
     * @param int $idPaymentModule Corresponde al identificador del método de pago.
     * @param String $namePaymentModule Corresponde al nombre del método de pago
     */
    function PaymentModule($idPaymentModule, $namePaymentModule) 
    {
        $this->idPaymentModule = $idPaymentModule;
        $this->namePaymentModule = $namePaymentModule;
    }//Fin de la función constructora

    function getIdPaymentModule() {
        return $this->idPaymentModule;
    }

    function getNamePaymentModule() {
        return $this->namePaymentModule;
    }

    function setIdPaymentModule($idPaymentModule) {
        $this->idPaymentModule = $idPaymentModule;
    }

    function setNamePaymentModule($namePaymentModule) {
        $this->namePaymentModule = $namePaymentModule;
    }


}//Fin de la clase