<?php

namespace Coreproc\PesoPay\Sdk;

use GuzzleHttp\Client;

class PesoPayMerchantApiClient
{

    private $loginId;

    private $password;

    private $actionType;

    private $payRef;

    private $amount;

    private $startDate;

    private $endDate;

    private $merchantId;

    private $orderRef;

    private $guzzleClient;

    private $testing;

    private $prodUrl;

    private $testingUrl;

    /**
     * PesoPayMerchantApiClient constructor.
     *
     * @param null|string $merchantId
     * @param null|string $loginId
     * @param null|string $password
     */
    public function __construct($merchantId = null, $loginId = null, $password = null)
    {
        $this->loginId = $loginId;

        $this->password = $password;

        $this->merchantId = $merchantId;

        $this->testing = true;

        $this->prodUrl = 'https://www.pesopay.com/b2c2/eng/merchant/api/orderApi.jsp';

        $this->testingUrl = 'https://test.pesopay.com/b2cDemo/eng/merchant/api/orderApi.jsp';

        $this->guzzleClient = new Client();
    }

    /**
     * @return $this
     */
    public function forProduction()
    {
        $this->testing = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function forTesting()
    {
        $this->testing = true;

        return $this;
    }

    /**
     * @param string $loginId
     * @return PesoPayMerchantApiClient
     */
    public function setLoginId($loginId)
    {
        $this->loginId = $loginId;

        return $this;
    }

    /**
     * @param string $password
     * @return PesoPayMerchantApiClient
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param int $merchantId
     * @return PesoPayMerchantApiClient
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @param string $loginId
     * @param string $password
     * @return PesoPayMerchantApiClient
     */
    public function setCredentials($loginId, $password)
    {
        $this->loginId = $loginId;

        $this->password = $password;

        return $this;

    }

    /**
     * @param string $actionType use const of PesosPayMerchantActionType
     * @return PesoPayMerchantApiClient
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;

        return $this;
    }

    /**
     * @param string $orderRef
     * @return PesoPayMerchantApiClient
     */
    public function setOrderReference($orderRef)
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    /**
     * @param string $paymentRef
     * @return PesoPayMerchantApiClient
     */
    public function setPaymentReference($paymentRef)
    {
        $this->payRef = $paymentRef;

        return $this;
    }

    /**
     * @param float $amount
     * @return PesoPayMerchantApiClient
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param string $startDate
     * @return PesoPayMerchantApiClient
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @param string $endDate
     * @return PesoPayMerchantApiClient
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->testing ? $this->testingUrl : $this->prodUrl;
    }

    /**
     * @param $prodUrl
     * @return $this
     */
    public function setProdUrl($prodUrl)
    {
        $this->prodUrl = $prodUrl;

        return $this;
    }

    /**
     * @param $testingUrl
     * @return $this
     */
    public function setTestingUrl($testingUrl)
    {
        $this->testingUrl = $testingUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $url = $this->getUrl();

        $formData = [
            'verify'      => false,
            'form_params' => [
                'loginId'    => $this->loginId,
                'password'   => $this->password,
                'actionType' => $this->actionType,
                'orderRef'   => $this->orderRef,
                'payRef'     => $this->payRef,
                'amount'     => $this->amount,
                'merchantId' => $this->merchantId
            ]
        ];

        $response = $this->guzzleClient->request('POST', $url, $formData);

        return $response;
    }
}