<?php namespace Mnel\Peach\Commands;

interface CommandHandlerTransalator
{
    /**
     * @param Command $command
     * @return CommandHandler
     */
    public function translateCommand(Command $command);
}
