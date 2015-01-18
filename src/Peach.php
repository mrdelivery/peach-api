<?php namespace Mnel\Peach;

use Mnel\Peach\Commands\Command;
use Mnel\Peach\Commands\CommandBus;

class Peach
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function processCommand(Command $command)
    {
        return $this->commandBus->push($command);
    }
}
