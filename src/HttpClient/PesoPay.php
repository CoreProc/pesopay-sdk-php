<?php
/**
 * Created by PhpStorm.
 * User: coreproc
 * Date: 7/11/2016
 * Time: 5:19 PM
 */

namespace Coreproc\HttpClient;

class PesoPay
{

    // @var string The base URL for the Pesopay API.
    private $apiBaseUrl;

    public function _construct($apiBaseUrl = null)
    {
        $this->apiBaseUrl = $apiBaseUrl;
    }

    public function getApiUrl()
    {
        return $this->apiBaseUrl;
    }

    public function setApiUrl($apiBaseUrl)
    {
        $this->apiBaseUrl = $apiBaseUrl;
    }
}