<?php

namespace Coreproc\PesoPay\Sdk;

use GuzzleHttp\Client;

class PesoPayClientPostThrough
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

    // @var string The redirect URL when the transaction is successful.
    private $successUrl;

    // @var string The redirect URL when the transaction fails.
    private $failUrl;

    // @var string The redirect URL when the transaction is canceled.
    private $cancelUrl;

    // @var string The hash computed
    private $secureHash;

    //@var string If you want to disable the print button, use the 'no' value
    private $print;

    //@var int Seconds before redirecting to the fail or success page
    private $redirect;

    // @var array The name of the properties used in the API
    private $fillables = [
        'orderRef',
        'amount',
        'currCode',
        'merchantId',
        'secretCode',
        'payType',
        'successUrl',
        'failUrl',
        'cancelUrl',
        'print',
        'redirect'
    ];


    /**
     * PesoPayClientPostThrough constructor.
     *
     * PesoPayClientPostThrough accept an array of constructor parameters
     * and an optional testing environment boolean parameter
     *
     * Here's an example of creating a PesoPayDirectClient
     * using an array of the default parameters.
     *
     * First parameter consists of the common parameters
     *
     * Second parameter is optional and will activate the debug url if set to true
     * Otherwise it defaults to false and will use the live url
     *
     *     $client = new PesoPayClientPostThrough([
     *         'orderRef'           => 1234523,
     *         'amount'             => 1000,
     *         'currCode'           => 608,
     *         'merchantId'         => 18064182,
     *         'secretCode'         => 'A5PNa2owJZEm20PI2gf0yyg5gAS3toig',
     *         'payType'            => 'N',
     *         'successUrl'         => 'http://google.com',
     *         'failUrl'            => 'http://youtube.com',
     *         'print'              => 'no',
     *         'redirect'           => 0
     *     ], true);
     *
     * $client->generateHtml();
     *
     * If you want to display the form, pass the false as an argument to generateHtml function
     *
     * PesoPayClientPostThrough configuration settings include the following options:
     *
     * @param array $params
     * @param bool $useTestUrl
     *
     */
    public function __construct(array $params = [], $useTestUrl = false)
    {
        $this->initGuzzleClient();

        $this->redirect = 0;

        $this->print = 'no';
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
     * @param $secretCode
     * @return $this
     */
    public function setSecretCode($secretCode)
    {
        $this->secretCode = $secretCode;
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

    /**
     * @return mixed
     */
    public function getSuccessUrl()
    {
        return $this->successUrl;
    }

    /**
     * @param $successUrl
     * @return $this
     */
    public function setSuccessUrl($successUrl)
    {
        $this->successUrl = $successUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFailUrl()
    {
        return $this->failUrl;
    }

    /**
     * @param $failUrl
     * @return $this
     */
    public function setFailUrl($failUrl)
    {
        $this->failUrl = $failUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * @param $cancelUrl
     * @return $this
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;
        return $this;
    }

    private function generateSecureHash()
    {
        $this->secureHash = sha1($this->merchantId . '|' .
            $this->orderRef . '|' .
            $this->currCode . '|' .
            $this->amount . '|' .
            $this->payType . '|' .
            $this->secretCode);
    }

    public function generateHtml($isAutoSubmit=true)
    {
        $this->generateSecureHash();

        $orderRefHtml   = '<div><input type="text" name="orderRef" value="'.$this->orderRef.'"></div>';
        $amountHtml     = '<div><input type="text" name="amount" value="'.$this->amount.'"></div>';
        $currCodeHtml   = '<div><input type="text" name="currCode" value="'.$this->currCode.'"></div>';
        $merchantIdHtml = '<div><input type="text" name="merchantId" value="'.$this->merchantId.'"></div>';
        $secureHashHtml = '<div><input type="text" name="secureHash" value="'.$this->secureHash.'"></div>';
        $payTypeHtml    = '<div><input type="text" name="payType" value="'.$this->payType.'"></div>';
        $successUrlHtml = '<div><input type="text" name="successUrl" value="'.$this->successUrl.'"></div>';
        $failUrlHtml    = '<div><input type="text" name="failUrl" value="'.$this->failUrl.'"></div>';
        $cancelUrlHtml  = '<div><input type="text" name="cancelUrl" value="'.$this->cancelUrl.'"></div>';
        $needPrintHtml  = '<div><input type="text" name="print" value="'.$this->print.'"></div>';
        $redirectHtml   = '<div><input type="text" name="redirect" value="'.$this->redirect.'"></div>';

        $hidden = $isAutoSubmit ? 'hidden' : "";
        $form = "
            <div $hidden>
                <form id= \"pesopay-client-form\" action=\"$this->apiUrl\" method=\"POST\">
                    $orderRefHtml
                    $amountHtml
                    $currCodeHtml
                    $merchantIdHtml
                    $secureHashHtml
                    $payTypeHtml
                    $successUrlHtml
                    $failUrlHtml
                    $cancelUrlHtml
                    $needPrintHtml
                    $redirectHtml
                    <input type='submit' value='submit'>
                </form>
            </div>
        ";

        $finalForm = ($isAutoSubmit) ? $form.$this->generateAutoSubmit() : $form;
        return $finalForm;

    }

    private function generateAutoSubmit()
    {
        return "
            <script>document.getElementById('pesopay-client-form').submit();</script>
        ";
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param mixed $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * @return mixed
     */
    public function getPrint()
    {
        return $this->print;
    }

    /**
     * @param mixed $print
     */
    public function setPrint($print)
    {
        $this->print = $print;
    }

}