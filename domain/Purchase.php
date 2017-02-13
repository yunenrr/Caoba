<?php

class Purchase {

    private $idpurchase;
    private $trademarkpurchase;
    private $seriepurchase;
    private $supplierpurchase;
    private $pricepurchase;
    private $idbuyerpurchase;
    private $idpaymenttypepurchase;

    function Purchase($idpurchase, $trademarkpurchase, $seriepurchase, $supplierpurchase, $pricepurchase, $idbuyerpurchase, $idpaymenttypepurchase) {
        $this->idpurchase = $idpurchase;
        $this->trademarkpurchase = $trademarkpurchase;
        $this->seriepurchase = $seriepurchase;
        $this->supplierpurchase = $supplierpurchase;
        $this->pricepurchase = $pricepurchase;
        $this->idbuyerpurchase = $idbuyerpurchase;
        $this->idpaymenttypepurchase = $idpaymenttypepurchase;
    }
    function getIdpurchase() {
        return $this->idpurchase;
    }

    function getTrademarkpurchase() {
        return $this->trademarkpurchase;
    }

    function getSeriepurchase() {
        return $this->seriepurchase;
    }

    function getSupplierpurchase() {
        return $this->supplierpurchase;
    }

    function getPricepurchase() {
        return $this->pricepurchase;
    }

    function getIdbuyerpurchase() {
        return $this->idbuyerpurchase;
    }

    function getIdpaymenttypepurchase() {
        return $this->idpaymenttypepurchase;
    }

    function setIdpurchase($idpurchase) {
        $this->idpurchase = $idpurchase;
    }

    function setTrademarkpurchase($trademarkpurchase) {
        $this->trademarkpurchase = $trademarkpurchase;
    }

    function setSeriepurchase($seriepurchase) {
        $this->seriepurchase = $seriepurchase;
    }

    function setSupplierpurchase($supplierpurchase) {
        $this->supplierpurchase = $supplierpurchase;
    }

    function setPricepurchase($pricepurchase) {
        $this->pricepurchase = $pricepurchase;
    }

    function setIdbuyerpurchase($idbuyerpurchase) {
        $this->idbuyerpurchase = $idbuyerpurchase;
    }

    function setIdpaymenttypepurchase($idpaymenttypepurchase) {
        $this->idpaymenttypepurchase = $idpaymenttypepurchase;
    }


}
