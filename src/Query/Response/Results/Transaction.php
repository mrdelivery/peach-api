<?php namespace Mnel\Peach\Query\Response\Results;

use Mnel\Peach\Query\Request\Criteria\ProcessingResult;
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

    public static $successfulReturnCodes = [
        '000.000.000',
        '000.400.000',
        '000.400.010',
        '000.400.020',
        '000.400.030',
        '000.400.040',
        '000.400.050',
        '000.400.060',
        '000.400.070',
        '000.400.080',
        '000.400.090',
    ];

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

    public function isSuccessful() //TODO: test
    {
        $successfulResult = $this->getProcessing()->getResult() == ProcessingResult::ACK;

        $isSuccessfulReturnCode = in_array($this->getProcessing()->getReturnCode(), static::$successfulReturnCodes);

        return $successfulResult && $isSuccessfulReturnCode;
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
