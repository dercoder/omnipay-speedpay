<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'apiKey'     => 'fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936',
            'merchantId' => 'lyAS41g0fJoIz1d',
            'bankId'     => '123',
            'userId'     => '1234567',
            'name'       => 'John Doe',
            'amount'     => 12.43,
            'currency'   => 'TRY',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $data['apikey']);
        $this->assertSame('lyAS41g0fJoIz1d', $data['merchantid']);
        $this->assertSame('123', $data['bankid']);
        $this->assertSame('1234567', $data['userid']);
        $this->assertSame('John Doe', $data['name']);
        $this->assertSame('12.43', $data['amount']);

        $this->request->setCurrency('EUR');
        $this->setExpectedException('\Omnipay\Common\Exception\InvalidRequestException');
        $this->request->getData();
    }

    public function testSendDataSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\PurchaseResponse', $response);
    }

    public function testSendDataFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\PurchaseResponse', $response);
    }
}
