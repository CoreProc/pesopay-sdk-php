<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 29/09/2017
 * Time: 2:31 PM
 */

namespace Coreproc\PesoPay\Sdk\Utils;

use Coreproc\PesoPay\Sdk\Exceptions\InvalidPRCException;

class ResponseCode
{
    /**
     * @var string Primary Response Code
     */
    private $primary;

    /**
     * @var null|string Secondary Response Code
     */
    private $secondary;

    private $primaryDescription;

    private $secondaryDescription;

    public function __construct($primary, $secondary)
    {
        $this->primary = $primary;
        $this->secondary = $secondary;

        $this->parse();
    }

    public function getFullDescription()
    {
        return $this->getPrimaryDescription() . ': ' . $this->getSecondaryDescription();
    }

    public function getPrimaryDescription()
    {
        return $this->primaryDescription;
    }

    public function getSecondaryDescription()
    {
        return $this->secondaryDescription;
    }

    private function parse()
    {
        switch ($this->primary) {
            case 0:
                $this->primaryDescription = 'Success';
                break;
            case 1: {
                $this->primaryDescription = 'Rejected by Payment Bank';
                switch ($this->secondary) {
                    case 01:
                    case 02:
                    case 05:
                    case 51:
                        $this->secondaryDescription = 'Bank Decline';
                        break;
                    case 14:
                        $this->secondaryDescription = 'Input Error';
                        break;
                    case 41:
                    case 43:
                        $this->secondaryDescription = 'Lost / Stolen Card';
                        break;
                }
                break;
            }
            case 3:
                $this->primaryDescription = 'Rejected due to Payer Authentication Failure (3D)';
                break;
            case -1:
                $this->primaryDescription = 'Rejected due to Input Parameters Incorrect';
                break;
            case -2:
                $this->primaryDescription = 'Rejected due to Server Access Error';
                break;
            case -8: {
                $this->primaryDescription = 'Rejected due to PesoPay Internal/Fraud Prevention Checking';
                switch ($this->secondary) {
                    case 999:
                    case 2011:
                        $this->secondaryDescription = 'Other';
                        break;
                    case 1000:
                        $this->secondaryDescription = 'Skipped transaction';
                        break;
                    case 2000:
                        $this->secondaryDescription = 'Blacklist error';
                        break;
                    case 2001:
                        $this->secondaryDescription = 'Blacklist card by system';
                        break;
                    case 2002:
                        $this->secondaryDescription = 'Blacklist card by merchant';
                        break;
                    case 2003:
                        $this->secondaryDescription = 'Blacklist IP by system';
                        break;
                    case 2004:
                        $this->secondaryDescription = 'Blacklist IP by merchant';
                        break;
                    case 2005:
                        $this->secondaryDescription = 'Invalid cardholder name';
                        break;
                    case 2006:
                        $this->secondaryDescription = 'Same card used more that 6 times a day';
                        break;
                    case 2007:
                        $this->secondaryDescription = 'Duplicate merchant reference no.';
                        break;
                    case 2008:
                        $this->secondaryDescription = 'Empty merchant reference no.';
                        break;
                    case 2012:
                        $this->secondaryDescription = 'Card verification failed';
                        break;
                    case 2013:
                        $this->secondaryDescription = 'Card already registered';
                        break;
                    case 2014:
                        $this->secondaryDescription = 'High risk country';
                        break;
                    case 2016:
                        $this->secondaryDescription = 'Same payer IP attempted more than pre-defined no. a day';
                        break;
                    case 2017:
                        $this->secondaryDescription = 'Invalid card number';
                        break;
                    case 2018:
                        $this->secondaryDescription = 'Multi-card attempt';
                        break;
                }
                break;
            }
            case -9:
                $this->primaryDescription = 'Rejected by Host Access Error';
                break;
            case -10:
                $this->primaryDescription = 'System Error';
                break;
            default:
                throw new InvalidPRCException;
        }
    }
}