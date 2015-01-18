<?php namespace Mnel\Peach\Query\Response;

class Response
{
    /** @var Result */
    private $result;

    /** @var ResponseError */
    private $error;

    protected function __construct(Result $result = null, ResponseError $error = null)
    {
        $this->result = $result;
        $this->error = $error;
    }

    public static function makeError(ResponseError $error)
    {
        return new static(null, $error);
    }

    public static function makeResult(Result $result)
    {
        return new static($result);
    }

    public function isError()
    {
        return !is_null($this->error);
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
