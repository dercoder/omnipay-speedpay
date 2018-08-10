<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompleteTransactionRequestTest extends TestCase
{
    public function testPurchaseSendData()
    {
        $httpRequest = new HttpRequest([], [], [], [], [], [], json_encode([
            'type'   => 'deposit',
            'status' => 1,
            'msg'    => 'Onaylandı',
            'data'   => [
                'depositid' => 17276,
                'hash'      => '242b4ac36a84af823df74b113d0e7d0714ed2ba7',
                'amount'    => 12.43,
                'userid'    => 112,
                'info'      => 'message',
            ],
        ]));

        $request = new CompleteTransactionRequest($this->getHttpClient(), $httpRequest);
        $data = $request->getData();
        $response = $request->sendData($data);
        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\CompletePurchaseResponse', $response);
    }

    public function testPayoutSendData()
    {
        $httpRequest = new HttpRequest([], [], [], [], [], [], json_encode([
            'type'   => 'withdraw',
            'status' => 1,
            'msg'    => 'Onaylandı',
            'data'   => [
                'depositid' => 17276,
                'hash'      => '242b4ac36a84af823df74b113d0e7d0714ed2ba7',
                'amount'    => 12.43,
                'userid'    => 112,
                'info'      => 'message',
            ],
        ]));

        $request = new CompleteTransactionRequest($this->getHttpClient(), $httpRequest);
        $data = $request->getData();
        $response = $request->sendData($data);
        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\CompletePayoutResponse', $response);
    }

    public function testInvalidJsonException()
    {
        $httpRequest = new HttpRequest([], [], [], [], [], [], 'XXXXX');

        $request = new CompleteTransactionRequest($this->getHttpClient(), $httpRequest);
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidRequestException');
        $data = $request->getData();
        $request->sendData($data);
    }

    public function testInvalidTypeException()
    {
        $httpRequest = new HttpRequest([], [], [], [], [], [], json_encode([
            'type' => 'XXXX',
        ]));

        $request = new CompleteTransactionRequest($this->getHttpClient(), $httpRequest);
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidRequestException');
        $data = $request->getData();
        $request->sendData($data);
    }
}
