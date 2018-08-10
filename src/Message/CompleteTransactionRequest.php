<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class CompleteTransactionRequest extends AbstractRequest
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

        return $data;
    }

    /**
     * @param mixed $data
     *
     * @return CompletePayoutResponse|CompletePurchaseResponse
     * @throws InvalidRequestException
     */
    public function sendData($data)
    {
        if ($data['type'] === 'deposit') {
            return new CompletePurchaseResponse($this, $data);
        } elseif ($data['type'] === 'withdraw') {
            return new CompletePayoutResponse($this, $data);
        } else {
            throw new InvalidRequestException('Invalid type. Deposit or withdraw required');
        }
    }
}
