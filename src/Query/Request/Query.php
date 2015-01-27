<?php namespace Mnel\Peach\Query\Request;

use Mnel\Peach\Query\Request\Criteria\Account;
use Mnel\Peach\Query\Request\Criteria\Identification;
use Mnel\Peach\Query\Request\Criteria\PaymentMethod;
use Mnel\Peach\Query\Request\Criteria\PaymentType;
use Mnel\Peach\Query\Request\Criteria\Period;
use Mnel\Peach\Query\Request\Criteria\ProcessingResult;
use Mnel\Peach\Query\Request\Criteria\QueryLevel;
use Mnel\Peach\Query\Request\Criteria\QueryMode;
use Mnel\Peach\Query\Request\Criteria\QueryType;
use Mnel\Peach\Query\Request\Criteria\TransactionType;
use Mnel\Peach\Query\Request\Criteria\User;

/**
 * Determines the processing of the query.
 *
 * @package Mnel\Peach\Request
 */
class Query
{
    /**
     * ID of the entity specified in level. The entity ID is
     * a unique key for the identification of the unit
     * which sends transactions into the system.
     *
     * @var string
     */
    private $entity;

    /** @var \Mnel\Peach\Query\Request\Criteria\User */
    private $user;

    /** @var Period */
    private $period;

    /** @var string */
    private $mode = QueryMode::INTEGRATOR_TEST;

    /** @var string */
    private $level = QueryLevel::CHANNEL;

    /** @var string */
    private $type = QueryType::STANDARD;

    /**
     * Maximum number of returned transactions by the query.
     * Especially helpful if you want to get the last 10
     * transaction only for an overview or similar to
     * speedup your application.
     *
     * @var int
     */
    private $maxCount = 100;

    /** @var Identification */
    private $identification = null;

    /** @var array|PaymentMethod[] */
    private $paymentMethods = [];

    /** @var array|PaymentType[] */
    private $paymentTypes = [];

    /** @var \Mnel\Peach\Query\Request\Criteria\ProcessingResult */
    private $processingResult = null;

    /** @var Account */
    private $account = null;

    /** @var TransactionType */
    private $transactionType = null;

    public function __construct($entity, User $user, Period $period = null)
    {
        $this->entity = $entity;
        $this->user = $user;
        $this->period = $period;
    }

    /**
     * @return TransactionType
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * @param TransactionType $transactionType
     */
    public function setTransactionType(TransactionType $transactionType)
    {
        $this->transactionType = $transactionType;
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return int
     */
    public function getMaxCount()
    {
        return $this->maxCount;
    }

    /**
     * @param int $maxCount
     */
    public function setMaxCount($maxCount)
    {
        $this->maxCount = $maxCount;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Identification
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @param Identification $identification
     */
    public function setIdentification(Identification $identification)
    {
        $this->identification = $identification;
    }

    /**
     * @return Period
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param Period $period
     */
    public function setPeriod(Period $period)
    {
        $this->period = $period;
    }

    /**
     * @return array|PaymentMethod[]
     */
    public function getPaymentMethods()
    {
        return $this->paymentMethods;
    }

    /**
     * @param array|\Mnel\Peach\Query\Request\Criteria\PaymentMethod[] $paymentMethods
     */
    public function setPaymentMethods(array $paymentMethods)
    {
        $this->paymentMethods = $paymentMethods;
    }

    /**
     * @param array $paymentMethodCodes
     * @internal param array|Criteria\PaymentMethod[] $paymentMethods
     */
    public function setPaymentMethodsByCode(array $paymentMethodCodes) //TODO: test
    {
        $paymentMethods = [];

        foreach ($paymentMethodCodes as $paymentMethodCode) {
            $paymentMethods[] = new PaymentMethod($paymentMethodCode);
        }

        $this->paymentMethods = $paymentMethods;
    }

    /**
     * @return array|PaymentType[]
     */
    public function getPaymentTypes()
    {
        return $this->paymentTypes;
    }

    /**
     * @param array|PaymentType[] $paymentTypes
     */
    public function setPaymentTypes(array $paymentTypes)
    {
        $this->paymentTypes = $paymentTypes;
    }

    /**
     * @param array|string[] $paymentTypeCodes Array of payment type codes.
     */
    public function setPaymentTypesByCode(array $paymentTypeCodes) //TODO: test this
    {
        $paymentTypes = [];

        foreach ($paymentTypeCodes as $paymentTypeCode) {
            $paymentTypes[] = new PaymentType($paymentTypeCode);
        }

        $this->paymentTypes = $paymentTypes;
    }

    /**
     * @return \Mnel\Peach\Query\Request\Criteria\ProcessingResult
     */
    public function getProcessingResult()
    {
        return $this->processingResult;
    }

    /**
     * @param \Mnel\Peach\Query\Request\Criteria\ProcessingResult $processingResult
     */
    public function setProcessingResult(ProcessingResult $processingResult)
    {
        $this->processingResult = $processingResult;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount(Account $account)
    {
        $this->account = $account;
    }
}
