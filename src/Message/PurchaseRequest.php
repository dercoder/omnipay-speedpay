<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PurchaseRequest extends AbstractRequest
{
    /**
     * @return int
     */
    public function getBankId()
    {
        return $this->getParameter('bankId');
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setBankId($value)
    {
        return $this->setParameter('bankId', $value);
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->getParameter('userId');
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setUserId($value)
    {
        return $this->setParameter('userId', $value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getParameter('name');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'apiKey',
            'merchantId',
            'bankId',
            'userId',
            'name',
            'amount',
            'currency'
        );

        if ($this->getCurrency() !== 'TRY') {
            throw new InvalidRequestException('Invalid currency. Only TRY is allowed!');
        }

        return [
            'apikey'     => $this->getApiKey(),
            'merchantid' => $this->getMerchantId(),
            'bankid'     => $this->getBankId(),
            'userid'     => $this->getUserId(),
            'name'       => $this->getName(),
            'amount'     => $this->getAmount(),
        ];
    }

    /**
     * @param array $data
     *
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('deposit');
        $response = $this->httpClient
            ->post($uri)
            ->setBody(json_encode($data), 'application/json')
            ->send();

        $data = json_decode($response->getBody(true), true);
        return new PurchaseResponse($this, $data);
    }
}
