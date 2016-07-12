<?php

namespace Coreproc\PesoPay\Sdk;

use GuzzleHttp\Client;

class PesoPayDirectClient
{

    // @var string The order reference number
    private $orderRef;

    // @var string The amount to be paid
    private $amount;

    // @var string The currency code
    private $currCode;

    // @var string The merchant ID
    private $merchantId;

    // @var string The payment method
    private $pMethod;

    // @var string The card expiry month
    private $epMonth;

    // @var string The card expiry year
    private $epYear;

    // @var string The card number
    private $cardNo;

    // @var string The card holder
    private $cardHolder;

    // @var string The security code
    private $securityCode;

    // @var string The payment type
    private $payType;

    // @var object The Guzzle Client object
    private $client;

    // @var string The base URL for the Pesopay API.
    private $apiUrl;

    public function _construct(Client $client, $debug = false)
    {
        $this->client = $client;
        $this->apiUrl = $debug ? 'https://test.pesopay.com/b2cDemo/eng/directPay/payComp.jsp' : 'https://www.pesopay.com/b2c2/eng/directPay/payComp.jsp';

    }

    /**
     * @return mixed
     */
    public function getOrderReference()
    {
        return $this->orderRef;
    }

    /**
     * @param $orderRef
     * @return $this
     */
    public function setOrderReference($orderRef)
    {
        $this->orderRef = $orderRef;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrencyCode()
    {
        return $this->currCode;
    }

    /**
     * @param $currCode
     * @return $this
     */
    public function setCurrencyCode($currCode)
    {
        $this->currCode = $currCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentMethod()
    {
        return $this->pMethod;
    }

    /**
     * @param $pMethod
     * @return $this
     */
    public function setPaymentMethod($pMethod)
    {
        $this->pMethod = $pMethod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardExpiryMonth()
    {
        return $this->epMonth;
    }

    /**
     * @param $epMonth
     * @return $this
     */
    public function setCardExpiryMonth($epMonth)
    {
        $this->epMonth = $epMonth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardExpiryYear()
    {
        return $this->epYear;
    }

    /**
     * @param $epYear
     * @return $this
     */
    public function setCardExpiryYear($epYear)
    {
        $this->epYear = $epYear;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardNo()
    {
        return $this->cardNo;
    }

    /**
     * @param $cardNo
     * @return $this
     */
    public function setCardNo($cardNo)
    {
        $this->cardNo = $cardNo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardHolder()
    {
        return $this->cardHolder;
    }

    /**
     * @param $cardHolder
     * @return $this
     */
    public function setCardHolder($cardHolder)
    {
        $this->cardHolder = $cardHolder;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardSecurityCode()
    {
        return $this->securityCode;
    }

    /**
     * @param $securityCode
     * @return $this
     */
    public function setCardSecurityCode($securityCode)
    {
        $this->securityCode = $securityCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayType()
    {
        return $this->payType;
    }

    /**
     * @param $payType
     * @return $this
     */
    public function setPayType($payType)
    {
        $this->payType = $payType;
        return $this;
    }

    public function execute()
    {
        $client = $this->client;

        $headers = array(); //TODO: Apply acquisition of headers
        $params  =
            [
                'orderRef'     => $this->orderRef,
                'amount'       => $this->amount,
                'currCode'     => $this->currCode,
                'merchantId'   => $this->merchantId,
                'pMethod'      => $this->pMethod,
                'epMonth'      => $this->epMonth,
                'epYear'       => $this->epYear,
                'cardNo'       => $this->cardNo,
                'cardHolder'   => $this->cardHolder,
                'securityCode' => $this->securityCode,
                'payType'      => $this->payType,
            ];

        return $client->request('POST', $this->apiUrl, array('headers' => $headers, 'form_params' => $params));

    }


}