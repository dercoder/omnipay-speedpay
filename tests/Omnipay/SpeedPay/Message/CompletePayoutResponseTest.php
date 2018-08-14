<?php

namespace Omnipay\SpeedPay\Message;

use Omnipay\Tests\TestCase;

class CompletePayoutResponseTest extends TestCase
{
    /**
     * @var PayoutRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new CompletePayoutRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $response = new CompletePayoutResponse($this->request, [
            'type'   => 'withdraw',
            'status' => 1,
            'msg'    => 'Onaylandı',
            'data'   => [
                [
                    'withdrawid' => 2877,
                    'hash'       => '242b4ac36a84af823df74b113d0e7d0714ed2ba7',
                    'amount'     => 12.43,
                    'userid'     => 113,
                    'info'       => 'message',
                ],
            ],
        ]);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(1, $response->getCode());
        $this->assertSame('Onaylandı', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertSame(2877, $response->getWithdrawId());
        $this->assertSame(2877, $response->getTransactionReference());
        $this->assertSame(12.43, $response->getAmount());
        $this->assertSame('242b4ac36a84af823df74b113d0e7d0714ed2ba7', $response->getHash());
        $this->assertSame(113, $response->getUserId());
        $this->assertSame('message', $response->getInfo());
    }

    public function testFailure()
    {
        $response = new CompletePayoutResponse($this->request, [
            'type'   => 'withdraw',
            'status' => 2,
            'msg'    => 'Failed',
        ]);

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame(2, $response->getCode());
        $this->assertSame('Failed', $response->getMessage());
        $this->assertNull($response->getWithdrawId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getAmount());
        $this->assertNull($response->getHash());
        $this->assertNull($response->getUserId());
        $this->assertNull($response->getInfo());
    }
}
