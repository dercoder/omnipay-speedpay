<?php

namespace Omnipay\SpeedPay;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    public $gateway;

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setApiKey('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936');
        $this->gateway->setMerchantId('lyAS41g0fJoIz1d');
    }

    public function testFetchBankList()
    {
        $request = $this->gateway->fetchBankList();

        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\FetchBankListRequest', $request);
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $request->getApiKey());
        $this->assertSame('lyAS41g0fJoIz1d', $request->getMerchantId());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([
            'bankId'   => '123',
            'userId'   => '1234567',
            'name'     => 'John Doe',
            'amount'   => 12.43,
            'currency' => 'TRY',
        ]);

        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\PurchaseRequest', $request);
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $request->getApiKey());
        $this->assertSame('lyAS41g0fJoIz1d', $request->getMerchantId());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase();

        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\CompletePurchaseRequest', $request);
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $request->getApiKey());
        $this->assertSame('lyAS41g0fJoIz1d', $request->getMerchantId());
    }

    public function testPayout()
    {
        $request = $this->gateway->payout([
            'bankId'         => '123',
            'userId'         => '1234567',
            'name'           => 'John Doe',
            'amount'         => 12.43,
            'currency'       => 'TRY',
            'identityNumber' => 'XXXXXXXXXXX',
            'iban'           => 'TRXX XXXX XXXX XXXX XXXX XXXX XX',
        ]);

        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\PayoutRequest', $request);
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $request->getApiKey());
        $this->assertSame('lyAS41g0fJoIz1d', $request->getMerchantId());
    }

    public function testCompletePayout()
    {
        $request = $this->gateway->completePayout();

        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\CompletePayoutRequest', $request);
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $request->getApiKey());
        $this->assertSame('lyAS41g0fJoIz1d', $request->getMerchantId());
    }

    public function testCompleteTransaction()
    {
        $request = $this->gateway->completeTransaction();

        $this->assertInstanceOf('\Omnipay\SpeedPay\Message\CompleteTransactionRequest', $request);
        $this->assertSame('fma7m2r2l15wtCUz0W9qhlgterKzsrfJbFrs2kK4GL936', $request->getApiKey());
        $this->assertSame('lyAS41g0fJoIz1d', $request->getMerchantId());
    }
}
