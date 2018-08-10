<?php

namespace Omnipay\SpeedPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\SpeedPay\Message\FetchBankListRequest;
use Omnipay\SpeedPay\Message\PurchaseRequest;
use Omnipay\SpeedPay\Message\CompletePurchaseRequest;
use Omnipay\SpeedPay\Message\PayoutRequest;
use Omnipay\SpeedPay\Message\CompletePayoutRequest;
use Omnipay\SpeedPay\Message\CompleteTransactionRequest;

class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'SpeedPay';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'apiKey'     => '',
            'merchantId' => '',
            'testMode'   => false,
        ];
    }

    /**
     * Get SpeedPay API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set SpeedPay API key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get SpeedPay merchant ID.
     *
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * Set SpeedPay merchant ID.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|FetchBankListRequest
     */
    public function fetchBankList(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SpeedPay\Message\FetchBankListRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SpeedPay\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SpeedPay\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|PayoutRequest
     */
    public function payout(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SpeedPay\Message\PayoutRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|CompletePayoutRequest
     */
    public function completePayout(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SpeedPay\Message\CompletePayoutRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return AbstractRequest|CompleteTransactionRequest
     */
    public function completeTransaction(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\SpeedPay\Message\CompleteTransactionRequest', $parameters);
    }
}
