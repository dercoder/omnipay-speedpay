<?php

namespace Omnipay\SpeedPay\Message;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /**
     * @return int|null
     */
    public function getCode()
    {
        return isset($this->data['result']) ? (int)$this->data['result'] : null;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return isset($this->data['msg']) ? $this->data['msg'] : null;
    }
}
