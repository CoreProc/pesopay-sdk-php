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

    // @var string The security code
    private $secretCode;

    // @var string The payment type
    private $payType;

    // @var object The Guzzle Client object
    private $client;

    // @var string The base URL for the Pesopay API.
    private $apiUrl;

    // @var array The name of the properties used in the API
    private $fillables = [
        'actionType',
        'orderRef',
        'amount',
        'currCode',
        'merchantId',
        'pMethod',
        'secretCode',
        'payType'
    ];


    /**
     * PesoPayDirectClient constructor.
     * @param bool $useTestUrl
     * @param array $params
     */
    public function __construct(array $params = [], $useTestUrl = false)
    {
        $this->initGuzzleClient();

        // Assign params to their proper properties
        $this->initParams($params);

        // Assigns testing url when $useTestUrl is true
        $this->apiUrl = $useTestUrl ? 'https://test.pesopay.com/b2cDemo/eng/payment/payForm.jsp' : 'https://www.pesopay.com/b2c2/eng/payment/payForm.jsp';

    }

    /**
     *
     */
    private function initGuzzleClient()
    {
        $this->client = new Client();
    }

    /**
     * @param array $params
     */
    public function initParams(array $params = [])
    {
        foreach ($params as $key => $value) {
            if (in_array($key, $this->fillables)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
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
    public function getSecretCode()
    {
        return $this->secretCode;
    }

    /**
     * @param $secureHash
     * @return $this
     */
    public function setSecretCode($secretCode)
    {
        $this->secretCode = secretCode;
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

        return $client->request('POST', $this->apiUrl, array('verify' => false, 'headers' => $headers, 'form_params' => $params));

    }


}