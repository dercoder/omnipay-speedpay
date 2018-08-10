<?php

namespace Omnipay\SpeedPay\Message;

class FetchBankListRequest extends AbstractRequest
{
    /**
     * @return array
     */
    public function getData()
    {
        $this->validate(
            'apiKey',
            'merchantId'
        );

        return [
            'apikey'     => $this->getApiKey(),
            'merchantid' => $this->getMerchantId(),
        ];
    }

    /**
     * @param array $data
     *
     * @return FetchBankListResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('banklist');
        $response = $this->httpClient
            ->post($uri)
            ->setBody(json_encode($data), 'application/json')
            ->send();

        $data = json_decode($response->getBody(true), true);
        return new FetchBankListResponse($this, $data);
    }
}
