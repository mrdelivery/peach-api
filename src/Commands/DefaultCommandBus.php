<?php namespace Mnel\Peach\Commands;

class DefaultCommandBus implements CommandBus
{
    /**
     * @var CommandHandlerTransalator
     */
    private $commandHandlerTransalator;

    public function __construct(CommandHandlerTransalator $commandHandlerTransalator)
    {
        $this->commandHandlerTransalator = $commandHandlerTransalator;
    }

    public function push(Command $command)
    {
        $handler = $this->commandHandlerTransalator->translateCommand($command);

        return $handler->handle($command);
    }
}
