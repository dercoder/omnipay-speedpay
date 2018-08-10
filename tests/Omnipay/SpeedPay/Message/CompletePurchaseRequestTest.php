<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePurchaseRequestTest extends TestCase
{
    /**
     * @var CompletePurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

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

        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->request->initialize([
            'apiKey'     => 'fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936',
            'merchantId' => 'lyAS41g0fJoIz1d',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('deposit', $data['type']);
        $this->assertSame(1, $data['status']);
        $this->assertSame('Onaylandı', $data['msg']);
        $this->assertSame(17276, $data['data']['depositid']);
        $this->assertSame('242b4ac36a84af823df74b113d0e7d0714ed2ba7', $data['data']['hash']);
        $this->assertSame(12.43, $data['data']['amount']);
        $this->assertSame(112, $data['data']['userid']);
        $this->assertSame('message', $data['data']['info']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\CompletePurchaseResponse', $response);
    }

    public function testInvalidJsonException()
    {
        $httpRequest = new HttpRequest([], [], [], [], [], [], 'XXXXX');

        $request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidRequestException');
        $request->getData();
    }

    public function testInvalidTypeException()
    {
        $httpRequest = new HttpRequest([], [], [], [], [], [], json_encode([
            'type' => 'withdraw',
        ]));

        $request = new CompletePurchaseRequest($this->getHttpClient(), $httpRequest);
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidRequestException');
        $request->getData();
    }
}
