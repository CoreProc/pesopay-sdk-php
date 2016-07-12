<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 7/11/16
 * Time: 6:39 PM
 */

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

    public function _construct($merchantId = null, $loginId=null, $password=null)
    {
        $this->loginId = $loginId;

        $this->password = $password;

        $this->merchantId = $this->merchantId;

        $this->testing = true;

        $this->prodUrl = 'https://www.pesopay.com/b2c2/eng/merchant/api/orderApi.jsp';

        $this->testingUrl = 'https://test.pesopay.com/b2cDemo/eng/merchant/api/orderApi.jsp';

        $this->initGuzzleClient();
    }


    private function initGuzzleClient()
    {
        $this->guzzleClient = new Client();
    }

    public function forProduction()
    {
        $this->testing = false;

        return $this;
    }

    public function forTesting()
    {
        $this->testing = true;

        return $this;
    }
    /**
     * @param string $loginId
     */
    public function setLoginId($loginId)
    {
        $this->loginId = $loginId;

        return $this;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param int $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @param string $loginId
     * @param string $password
     */
    public function setCredentials($loginId, $password)
    {
        $this->loginId = $loginId;

        $this->password = $password;

        return $this;

    }

    /**
     * @param string $actionType use const of PesosPayMerchantActionType
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;

        return $this;
    }

    /**
     * @param string $orderRef
     */
    public function setOrderReference($orderRef)
    {
        $this->orderRef = $orderRef;

        return $this;
    }

    /**
     * @param string $paymentRef
     */
    public function setPaymentReference($paymentRef)
    {
        $this->payRef = $paymentRef;

        return $this;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @param string $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @param $testing
     * @return mixed
     */
    public function getUrl($testing)
    {
        return $testing ? $this->testingUrl : $this->prodUrl;
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
        $url = $this->getUrl($this->testing);

        $formData = [
            'form_params' => [
               'loginId' => $this->loginId,
               'password' => $this->password
            ]
        ];

        $response = $this->guzzleClient->request('POST', $url, $formData);

        return $response;
    }
}