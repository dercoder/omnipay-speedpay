<?php

namespace Omnipay\SpeedPay\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $endpoint = 'https://api.speedpay.pw';

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
     * @param string $path
     *
     * @return string
     */
    protected function createUri($path)
    {
        return sprintf('%s/%s', $this->getEndpoint(), $path);
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }
}
