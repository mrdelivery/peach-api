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

    /**
     * @param ResponseError $error
     * @param Command       $command
     * @param string        $rawResponse
     */
    function __construct(ResponseError $error, Command $command, $rawResponse)
    {
        parent::__construct($error->getMessage());
        $this->error = $error;
        $this->command = $command;
        $this->rawResponse = $rawResponse;
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
    public function getRawResponse()
    {
        return $this->rawResponse;
    }
}
