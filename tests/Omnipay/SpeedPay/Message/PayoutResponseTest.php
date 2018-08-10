<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;

class PayoutResponseTest extends TestCase
{
    /**
     * @var PayoutRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PayoutRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PayoutSuccess.txt');
        $data = json_decode($httpResponse->getBody(true), true);
        $response = new PayoutResponse($this->request, $data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertTrue($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(200, $response->getCode());
        $this->assertSame('OK', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame(2877, $response->getWithdrawId());
        $this->assertSame(2877, $response->getTransactionReference());
        $this->assertSame(12.43, $response->getAmount());
        $this->assertSame('53747f796b5c764f015e8cd3d56a93c6662daf84', $response->getHash());
        $this->assertSame(113, $response->getUserId());
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PayoutFailure.txt');
        $data = json_decode($httpResponse->getBody(true), true);
        $response = new PayoutResponse($this->request, $data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(1, $response->getCode());
        $this->assertSame('Action Canceled When Pending Action Exists', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getWithdrawId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getAmount());
        $this->assertNull($response->getHash());
        $this->assertNull($response->getUserId());
    }
}
