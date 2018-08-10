<?php

namespace Omnipay\SpeedPay;

class Bank
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * Bank constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->data['bankid'];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->data['bankname'];
    }

    /**
     * @return string
     */
    public function getNameSurname()
    {
        return $this->data['namesurname'];
    }

    /**
     * @return int
     */
    public function getBranchCode()
    {
        return (int)$this->data['branchcode'];
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->data['accnumber'];
    }

    /**
     * @return int
     */
    public function getIban()
    {
        return $this->data['iban'];
    }

    /**
     * @return float
     */
    public function getMinAmount()
    {
        return (float)$this->data['minamount'];
    }

    /**
     * @return float
     */
    public function getMaxAmount()
    {
        return (float)$this->data['maxamount'];
    }
}
