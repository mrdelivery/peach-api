<?php namespace Mnel\Peach\Query\Response;

class Response
{
    /** @var Result */
    private $result;
    /** @var ResponseError */
    private $error;
    /** @var string */
    private $rawResponse;

    /**
     * @param string        $rawResponse
     * @param Result        $result
     * @param ResponseError $error
     */
    protected function __construct($rawResponse, Result $result = null, ResponseError $error = null)
    {
        $this->rawResponse = $rawResponse;
        $this->result = $result;
        $this->error = $error;
    }

    /**
     * @param string        $rawResponse
     * @param ResponseError $error
     * @return static
     */
    public static function makeError($rawResponse, ResponseError $error)
    {
        return new static($rawResponse, null, $error);
    }

    /**
     * @param string $rawResponse
     * @param Result $result
     * @return static
     */
    public static function makeResult($rawResponse, Result $result)
    {
        return new static($rawResponse, $result);
    }

    /**
     * @return bool
     */
    public function isError()
    {
        return !is_null($this->error);
    }

    /**
     * @return string
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    /**
     * @return Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return ResponseError
     */
    public function getError()
    {
        return $this->error;
    }
}
