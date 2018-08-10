<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;

class FetchBankListRequestTest extends TestCase
{
    /**
     * @var FetchBankListRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchBankListRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'apiKey'     => 'fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936',
            'merchantId' => 'lyAS41g0fJoIz1d',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $data['apikey']);
        $this->assertSame('lyAS41g0fJoIz1d', $data['merchantid']);
    }

    public function testSendDataSuccess()
    {
        $this->setMockHttpResponse('FetchBankListSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\FetchBankListResponse', $response);
    }

    public function testSendDataFailure()
    {
        $this->setMockHttpResponse('FetchBankListFailure.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\FetchBankListResponse', $response);
    }
}
