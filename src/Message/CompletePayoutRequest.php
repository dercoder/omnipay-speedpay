<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class CompletePayoutRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        if (!$data = json_decode($this->httpRequest->getContent(), true)) {
            throw new InvalidRequestException('Invalid json');
        }

        if (!isset($data['type']) || $data['type'] !== 'withdraw') {
            throw new InvalidRequestException('Invalid type. Withdraw required');
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return CompletePayoutResponse
     */
    public function sendData($data)
    {
        return new CompletePayoutResponse($this, $data);
    }
}
