<?php namespace Mnel\Peach\Query\Request;

/**
 * Holds transmission and security related information
 *
 * @package Mnel\Peach\Request
 */
class Header
{
    /**
     * Each entity (PSP, Division, Merchant, Channel) which sends requests to the system has an own sender unique ID.
     * The sender UID is no logical business orientatedsubdivision like the channel ID,
     * but refers to physical installations of software.
     *
     * Please provide here the value you have received from the customer support department.
     * Value: Alphanumeric 32
     *        e.g. 123a456b789c123d456e789f012g345
     *
     * @var string
     */
    private $sender;

    function __construct($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }
}
