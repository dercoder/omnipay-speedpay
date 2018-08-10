<?php

namespace Omnipay\SpeedPay;

use Omnipay\Tests\TestCase;

class BankTest extends TestCase
{
    /**
     * @var Bank
     */
    public $bank;

    public function setUp()
    {
        parent::setUp();
        $this->bank = new Bank([
            'bankid'      => '544',
            'bankname'    => 'Akbank',
            'namesurname' => 'Name Person',
            'branchcode'  => '1250',
            'accnumber'   => '76718330',
            'iban'        => 'TR68 0011 1000 0000 0076 7183 30',
            'minamount'   => '100',
            'maxamount'   => '50000',
        ]);
    }

    public function testBank()
    {
        $this->assertSame(544, $this->bank->getId());
        $this->assertSame('Akbank', $this->bank->getName());
        $this->assertSame('Name Person', $this->bank->getNameSurname());
        $this->assertSame(1250, $this->bank->getBranchCode());
        $this->assertSame('76718330', $this->bank->getAccountNumber());
        $this->assertSame('TR68 0011 1000 0000 0076 7183 30', $this->bank->getIban());
        $this->assertSame(100.00, $this->bank->getMinAmount());
        $this->assertSame(50000.00, $this->bank->getMaxAmount());
    }
}
