<?php

namespace Coreproc\PesoPay\Sdk\Utils;

class SecureHash
{
    /**
     * Verify the datafeed response.
     *
     * @note Included Merchant's secure hash secret in data param. Normally would access it from an config object or something.
     * @param array $data Response data from PesoPay plus Merchant's secure hash secret
     * @param string $hash Hash from PesoPay
     * @return bool
     */
    public static function isValid(array $data, $hash)
    {
        $dataString = $data['src'] . '|'
            . $data['prc'] . '|'
            . $data['successcode'] . '|'
            . $data['Ref'] . '|'
            . $data['PayRef'] . '|'
            . $data['Cur'] . '|'
            . $data['Amt'] . '|'
            . $data['payerAuth'] . '|'
            . $data['secretCode'];

        return sha1($dataString) === $hash;
    }
}