<?php namespace Mnel\Peach\Query\Response;

use Mnel\Peach\Query\Response\Results\Transaction;

class Result
{
    /**
     * All requested transactions are part of this request
     */
    const RESPONSE_SYNC = 'SYNC';

    /**
     * Specifies that the transactions are provided as a list
     */
    const TYPE_LIST = 'LIST';

    /**
     * @var string
     */
    private $response;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array|Transaction[]
     */
    private $transactions;

    function __construct($response = 'SYNC', $type = 'LIST', array $transactions = [])
    {
        $this->response = $response;
        $this->type = $type;
        $this->transactions = $transactions;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array|Transaction[]
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}
