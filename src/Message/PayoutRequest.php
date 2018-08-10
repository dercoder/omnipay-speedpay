<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class PayoutRequest extends AbstractRequest
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
     * @return string
     */
    public function getIdentityNumber()
    {
        return $this->getParameter('identityNumber');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setIdentityNumber($value)
    {
        return $this->setParameter('identityNumber', $value);
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->getParameter('iban');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setIban($value)
    {
        return $this->setParameter('iban', $value);
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
            'currency',
            'identityNumber',
            'iban'
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
            'identityno' => $this->getIdentityNumber(),
            'iban'       => $this->getIban(),
        ];
    }

    /**
     * @param array $data
     *
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('withdraw');
        $response = $this->httpClient
            ->post($uri)
            ->setBody(json_encode($data), 'application/json')
            ->send();

        $data = json_decode($response->getBody(true));
        return new PayoutResponse($this, $data);
    }
}
