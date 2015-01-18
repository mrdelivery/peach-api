<?php namespace Mnel\Peach\Query\Response;

use Carbon\Carbon;

class ResponseError
{
    /** @var Carbon */
    private $timestamp;

    /** @var string */
    private $code;

    /** @var string */
    private $message;

    function __construct($timestamp, $code, $message)
    {
        $this->timestamp = Carbon::parse($timestamp);
        $this->code = $code;
        $this->message = $message;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
