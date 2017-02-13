<?php

/**
 * Description of Buy
 *
 * @author Karen
 */
class Buy {

    // declaración de las variables
    public $idbuy;
    public $brandbuy;
    public $modelbuy;
    public $quantitybuy;
    public $buydatebuy;
    public $invoicenumberbuy;
    public $providerbuy;
    public $pricebuy;
    public $buyerbuy;
    public $paymentbuy;
    public $seriesbuy;

    //método constructor
    function Buy($idbuy, $brandbuy, $modelbuy, $quantitybuy, $buydatebuy, $invoicenumberbuy, $providerbuy, $pricebuy, $buyerbuy, $paymentbuy, $seriesbuy) {
        $this->idbuy = $idbuy;
        $this->brandbuy = $brandbuy;
        $this->modelbuy = $modelbuy;
        $this->quantitybuy = $quantitybuy;
        $this->buydatebuy = $buydatebuy;
        $this->invoicenumberbuy = $invoicenumberbuy;
        $this->providerbuy = $providerbuy;
        $this->pricebuy = $pricebuy;
        $this->buyerbuy = $buyerbuy;
        $this->paymentbuy = $paymentbuy;
        $this->seriesbuy= $seriesbuy;
    }// fin del método constructor
    
    function getIdbuy() {
        return $this->idbuy;
    }

    function getBrandbuy() {
        return $this->brandbuy;
    }

    function getModelbuy() {
        return $this->modelbuy;
    }

    function getQuantitybuy() {
        return $this->quantitybuy;
    }

    function getBuydatebuy() {
        return $this->buydatebuy;
    }

    function getInvoicenumberbuy() {
        return $this->invoicenumberbuy;
    }

    function getProviderbuy() {
        return $this->providerbuy;
    }

    function getPricebuy() {
        return $this->pricebuy;
    }

    function getBuyerbuy() {
        return $this->buyerbuy;
    }

    function getPaymentbuy() {
        return $this->paymentbuy;
    }

    function getSeriesbuy() {
        return $this->seriesbuy;
    }

    function setIdbuy($idbuy) {
        $this->idbuy = $idbuy;
    }

    function setBrandbuy($brandbuy) {
        $this->brandbuy = $brandbuy;
    }

    function setModelbuy($modelbuy) {
        $this->modelbuy = $modelbuy;
    }

    function setQuantitybuy($quantitybuy) {
        $this->quantitybuy = $quantitybuy;
    }

    function setBuydatebuy($buydatebuy) {
        $this->buydatebuy = $buydatebuy;
    }

    function setInvoicenumberbuy($invoicenumberbuy) {
        $this->invoicenumberbuy = $invoicenumberbuy;
    }

    function setProviderbuy($providerbuy) {
        $this->providerbuy = $providerbuy;
    }

    function setPricebuy($pricebuy) {
        $this->pricebuy = $pricebuy;
    }

    function setBuyerbuy($buyerbuy) {
        $this->buyerbuy = $buyerbuy;
    }

    function setPaymentbuy($paymentbuy) {
        $this->paymentbuy = $paymentbuy;
    }

    function setSeriesbuy($seriesbuy) {
        $this->seriesbuy = $seriesbuy;
    }


}
