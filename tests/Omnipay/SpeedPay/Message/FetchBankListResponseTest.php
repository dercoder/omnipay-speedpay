<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;

class FetchBankListResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchBankListRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('FetchBankListSuccess.txt');
        $data = json_decode($httpResponse->getBody(true), true);
        $response = new FetchBankListResponse($this->request, $data);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertArrayHasKey(0, $response->getList());
        $this->assertArrayHasKey(1, $response->getList());
        $this->assertCount(2, $response->getList());
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('FetchBankListFailure.txt');
        $data = json_decode($httpResponse->getBody(true), true);
        $response = new FetchBankListResponse($this->request, $data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(401, $response->getCode());
        $this->assertSame('Access Denied', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertArrayNotHasKey(0, $response->getList());
        $this->assertArrayNotHasKey(1, $response->getList());
        $this->assertCount(0, $response->getList());
    }
}
