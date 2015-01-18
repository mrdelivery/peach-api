<?php namespace Mnel\Peach\Query\Response\Results;

use Carbon\Carbon;

class Processing
{
    /** @var string */
    private $code;

    /** @var Carbon */
    private $timestamp;

    /** @var string */
    private $result;

    /** @var string */
    private $status;

    /** @var string */
    private $statusCode;

    /** @var string */
    private $reason;

    /** @var string */
    private $reasonCode;

    /** @var string */
    private $return;

    /** @var string */
    private $returnCode;

    /** @var string */
    private $connectorTxId;

    function __construct(
        $code,
        $timestamp,
        $result,
        $status,
        $statusCode,
        $reason,
        $reasonCode,
        $return,
        $returnCode,
        $connectorTxId
    ) {
        $this->code = $code;
        $this->timestamp = $timestamp;
        $this->result = $result;
        $this->status = $status;
        $this->statusCode = $statusCode;
        $this->reason = $reason;
        $this->reasonCode = $reasonCode;
        $this->return = $return;
        $this->returnCode = $returnCode;
        $this->connectorTxId = $connectorTxId;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return Carbon
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @return string
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @return string
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     * @return string
     */
    public function getConnectorTxId()
    {
        return $this->connectorTxId;
    }
}
