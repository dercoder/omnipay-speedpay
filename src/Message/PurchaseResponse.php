<?php

namespace Omnipay\SpeedPay\Message;

class PurchaseResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPending()
    {
        return $this->getCode() === 200;
    }

    /**
     * @return int|null
     */
    public function getTransactionReference()
    {
        return $this->getDepositId();
    }

    /**
     * @return int|null
     */
    public function getDepositId()
    {
        return isset($this->data['data'][0]['depositid']) ? (int)$this->data['data'][0]['depositid'] : null;
    }

    /**
     * @return string|null
     */
    public function getUserId()
    {
        return isset($this->data['data'][0]['userid']) ? (int)$this->data['data'][0]['userid'] : null;
    }

    /**
     * @return string|null
     */
    public function getHash()
    {
        return isset($this->data['data'][0]['hash']) ? $this->data['data'][0]['hash'] : null;
    }

    /**
     * @return float|null
     */
    public function getAmount()
    {
        return isset($this->data['data'][0]['amount']) ? (float)$this->data['data'][0]['amount'] : null;
    }
}
