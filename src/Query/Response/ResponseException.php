<?php namespace Mnel\Peach\Query\Response;

use Mnel\Peach\PeachException;

class ResponseException extends PeachException
{
    /** @var ResponseError */
    private $error;

    function __construct(ResponseError $error)
    {
        parent::__construct($error->getMessage());
        $this->error = $error;
    }

    /**
     * @return ResponseError
     */
    public function getError()
    {
        return $this->error;
    }
}
