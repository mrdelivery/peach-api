<?php namespace Mnel\Peach\Commands;

use Exception;
use Mnel\Peach\PeachException;

class CommandException extends PeachException
{
    /** @var Command */
    private $command;

    public function __construct(Command $command, $message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->command = $command;
    }

    /**
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }
}
