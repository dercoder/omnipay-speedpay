<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class CompletePurchaseRequest extends AbstractRequest
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

        if (!isset($data['type']) || $data['type'] !== 'deposit') {
            throw new InvalidRequestException('Invalid type. Deposit required');
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        return new CompletePurchaseResponse($this, $data);
    }
}
