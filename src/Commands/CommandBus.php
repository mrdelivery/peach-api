<?php namespace Mnel\Peach\Commands;

interface CommandBus
{
    /**
     * @param Command $command
     */
    public function push(Command $command);
}
