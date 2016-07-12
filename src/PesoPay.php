<?php
/**
 * Created by PhpStorm.
 * User: coreproc
 * Date: 7/11/2016
 * Time: 5:19 PM
 */

namespace Coreproc\PesoPay\Sdk;

class PesoPay
{

    // @var string The base URL for the Pesopay API.
    public static $apiBaseUrl;

    public function _construct($apiBaseUrl = null)
    {
        self::$apiBaseUrl = $apiBaseUrl;
    }

    public static function getApiUrl()
    {
        return self::$apiBaseUrl;
    }

    public static function setApiUrl($apiBaseUrl)
    {
        self::$apiBaseUrl = $apiBaseUrl;
    }
}