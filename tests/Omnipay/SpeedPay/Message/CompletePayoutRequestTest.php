<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CompletePayoutRequestTest extends TestCase
{
    /**
     * @var CompletePayoutRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();

        $httpRequest = new HttpRequest([], [], [], [], [], [], json_encode([
            'type'   => 'withdraw',
            'status' => 1,
            'msg'    => 'Onaylandı',
            'data'   => [
                'withdrawid' => 2877,
                'hash'      => '242b4ac36a84af823df74b113d0e7d0714ed2ba7',
                'amount'    => 12.43,
                'userid'    => 113,
                'info'      => 'message',
            ],
        ]));

        $this->request = new CompletePayoutRequest($this->getHttpClient(), $httpRequest);
        $this->request->initialize([
            'apiKey'     => 'fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936',
            'merchantId' => 'lyAS41g0fJoIz1d',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('withdraw', $data['type']);
        $this->assertSame(1, $data['status']);
        $this->assertSame('Onaylandı', $data['msg']);
        $this->assertSame(2877, $data['data']['withdrawid']);
        $this->assertSame('242b4ac36a84af823df74b113d0e7d0714ed2ba7', $data['data']['hash']);
        $this->assertSame(12.43, $data['data']['amount']);
        $this->assertSame(113, $data['data']['userid']);
        $this->assertSame('message', $data['data']['info']);
    }

    public function testSendData()
    {
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\CompletePayoutResponse', $response);
    }

    public function testInvalidJsonException()
    {
        $httpRequest = new HttpRequest([], [], [], [], [], [], 'XXXXX');

        $request = new CompletePayoutRequest($this->getHttpClient(), $httpRequest);
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidRequestException');
        $request->getData();
    }

    public function testInvalidTypeException()
    {
        $httpRequest = new HttpRequest([], [], [], [], [], [], json_encode([
            'type' => 'deposit',
        ]));

        $request = new CompletePayoutRequest($this->getHttpClient(), $httpRequest);
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidRequestException');
        $request->getData();
    }
}
