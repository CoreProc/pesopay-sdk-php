<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 7/12/16
 * Time: 12:27 PM
 */

namespace Coreproc\PesoPay\Sdk;

class PesoPayMerchantActionType
{
    const VOID = 'Void';

    const CAPTURE = 'Capture';

    const REQUESTREFUND = 'RequestRefund';

    const QUERY = 'Query';

}