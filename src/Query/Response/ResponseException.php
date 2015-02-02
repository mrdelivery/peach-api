<?php namespace Mnel\Peach\Query\Response;

use Mnel\Peach\Commands\Command;
use Mnel\Peach\PeachException;

class ResponseException extends PeachException
{
    /** @var ResponseError */
    private $error;
    /**
     * @var Command
     */
    private $command;
    /** @var string */
    private $rawResponse;
    /** @var string */
    private $rawRequest;

    /**
     * @param ResponseError $error
     * @param Command       $command
     * @param string        $rawRequest
     * @param string        $rawResponse
     */
    function __construct(ResponseError $error, Command $command, $rawRequest, $rawResponse)
    {
        parent::__construct($error->getMessage());
        $this->error = $error;
        $this->command = $command;
        $this->rawResponse = $rawResponse;
        $this->rawRequest = $rawRequest;
    }

    /**
     * @return ResponseError
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return string
     */
    public function getRawRequest()
    {
        return $this->rawRequest;
    }

    /**
     * @return string
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }
}
