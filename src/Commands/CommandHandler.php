<?php namespace Mnel\Peach\Commands;

interface CommandHandler
{
    /**
     * @param Command $command
     */
    public function handle(Command $command);
}
