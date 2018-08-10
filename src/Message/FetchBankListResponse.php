<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\SpeedPay\Bank;

class FetchBankListResponse extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data[0]);
    }

    /**
     * @return array
     */
    public function getList()
    {
        $result = [];

        if (!$this->isSuccessful()) {
            return $result;
        }

        foreach ($this->data as $data) {
            $result[] = new Bank($data);
        }

        return $result;
    }
}
