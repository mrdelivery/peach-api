<?php namespace Mnel\Peach\Commands;

/**
 * The CommandHandlerTranslator recieves a Command instance and
 * produces it's corresponding CommandHandler counter-part.
 *
 * The default implementation is the ArrayCommandHandlerTranslator.
 * It recieves an array of CommandHandler instances, indexed by
 * the Full Domain Name of the corresponding Command class.
 *
 * @package Mnel\Peach\Commands
 */
interface CommandHandlerTransalator
{
    /**
     * @param Command $command
     * @return CommandHandler
     */
    public function translateCommand(Command $command);
}
