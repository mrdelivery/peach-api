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

    function __construct(ResponseError $error, Command $command)
    {
        parent::__construct($error->getMessage());
        $this->error = $error;
        $this->command = $command;
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
}
