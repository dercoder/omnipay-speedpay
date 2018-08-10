<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $data = json_decode($httpResponse->getBody(true), true);
        $response = new PurchaseResponse($this->request, $data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertTrue($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(200, $response->getCode());
        $this->assertSame('OK', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame(17276, $response->getDepositId());
        $this->assertSame(17276, $response->getTransactionReference());
        $this->assertSame(12.43, $response->getAmount());
        $this->assertSame('242b4ac36a84af823df74b113d0e7d0714ed2ba7', $response->getHash());
        $this->assertSame(112, $response->getUserId());
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $data = json_decode($httpResponse->getBody(true), true);
        $response = new PurchaseResponse($this->request, $data);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(1, $response->getCode());
        $this->assertSame('Bekleyen Talep Mevcut Olduğundan İşlem İptal Edildi', $response->getMessage());
        $this->assertNull($response->getDepositId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getAmount());
        $this->assertNull($response->getHash());
        $this->assertNull($response->getUserId());
    }
}
