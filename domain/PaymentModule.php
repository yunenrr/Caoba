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
    private $idPaymentModule,$namePaymentModule,$pricePaymentModule;
    
    /**
     * Función constructora.
     * @param int $idPaymentModule Corresponde al identificador del método de pago.
     * @param String $namePaymentModule Corresponde al nombre del método de pago
     * @param Int $pricePaymentModule Corresponde al precio a aplicar para dicha modalidad de pago.
     */
    function PaymentModule($idPaymentModule, $namePaymentModule,$pricePaymentModule) 
    {
        $this->idPaymentModule = $idPaymentModule;
        $this->namePaymentModule = $namePaymentModule;
        $this->pricePaymentModule = $pricePaymentModule;
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
    function getPricePaymentModule() {
        return $this->pricePaymentModule;
    }

    function setPricePaymentModule($pricePaymentModule) {
        $this->pricePaymentModule = $pricePaymentModule;
    }

}//Fin de la clase