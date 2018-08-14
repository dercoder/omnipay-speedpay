<?php

namespace Omnipay\SpeedPay\Message;

class CompletePayoutResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->getCode() === 1;
    }

    /**
     * @return int|null
     */
    public function getCode()
    {
        return isset($this->data['status']) ? (int)$this->data['status'] : null;
    }

    /**
     * @return int|null
     */
    public function getTransactionReference()
    {
        return $this->getWithdrawId();
    }

    /**
     * @return int|null
     */
    public function getWithdrawId()
    {
        return isset($this->data['data'][0]['withdrawid']) ? (int)$this->data['data'][0]['withdrawid'] : null;
    }

    /**
     * @return int|null
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

    /**
     * @return float|null
     */
    public function getInfo()
    {
        return isset($this->data['data'][0]['info']) ? $this->data['data'][0]['info'] : null;
    }
}
