<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 7/11/16
 * Time: 6:39 PM
 */

namespace Coreproc\PesoPay\Sdk;

class PesoPayMerchantApiClient
{
    private $loginId;

    private $password;

    private $actionType;

    private $payRef;

    private $amount;

    private $startDate;

    private $endDate;

    public function _construct($loginId=null, $password=null)
    {
        $this->loginId = $loginId;

        $this->password = $password;
    }

    public function setLoginId($loginId)
    {
        $this->loginId = $loginId;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}