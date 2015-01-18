<?php namespace Mnel\Peach\Query\Response\Results;

use Mnel\Peach\Query\Response\Results\Customers\Customer;
use Mnel\Peach\Query\Response\Results\Payments\Payment;

class Transaction
{
    /** @var string */
    private $mode;

    /** @var string */
    private $channel;

    /** @var string */
    private $response;

    /** @var string */
    private $source;

    /**
     * @var Identification
     */
    private $identification;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var Account
     */
    private $account;

    /**
     * @var \Mnel\Peach\Query\Response\Results\Customers\Customer
     */
    private $customer;

    /**
     * @var Processing
     */
    private $processing;

    function __construct($mode, $channel, $response, $source, Identification $identification, Payment $payment, Account $account, Customer $customer, Processing $processing)
    {
        $this->mode = $mode;
        $this->channel = $channel;
        $this->response = $response;
        $this->source = $source;
        $this->identification = $identification;
        $this->payment = $payment;
        $this->account = $account;
        $this->customer = $customer;
        $this->processing = $processing;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return Identification
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @return \Mnel\Peach\Query\Response\Results\Payments\Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return \Mnel\Peach\Query\Response\Results\Customers\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return Processing
     */
    public function getProcessing()
    {
        return $this->processing;
    }
}
