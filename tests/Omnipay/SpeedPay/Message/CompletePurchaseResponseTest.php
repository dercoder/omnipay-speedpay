<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;

class CompletePurchaseResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new CompletePurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $response = new CompletePurchaseResponse($this->request, [
            'type'   => 'deposit',
            'status' => 1,
            'msg'    => 'Onaylandı',
            'data'   => [
                [
                    'depositid' => 17276,
                    'hash'      => '242b4ac36a84af823df74b113d0e7d0714ed2ba7',
                    'amount'    => 12.43,
                    'userid'    => 112,
                    'info'      => 'message',
                ]
            ],
        ]);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(1, $response->getCode());
        $this->assertSame('Onaylandı', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame(17276, $response->getDepositId());
        $this->assertSame(17276, $response->getTransactionReference());
        $this->assertSame(12.43, $response->getAmount());
        $this->assertSame('242b4ac36a84af823df74b113d0e7d0714ed2ba7', $response->getHash());
        $this->assertSame(112, $response->getUserId());
        $this->assertSame('message', $response->getInfo());
    }

    public function testFailure()
    {
        $response = new CompletePurchaseResponse($this->request, [
            'type'   => 'deposit',
            'status' => 0,
            'msg'    => 'Failed',
        ]);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(0, $response->getCode());
        $this->assertSame('Failed', $response->getMessage());
        $this->assertNull($response->getDepositId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getAmount());
        $this->assertNull($response->getHash());
        $this->assertNull($response->getUserId());
        $this->assertNull($response->getInfo());
    }
}
