<?php namespace Mnel\Peach\Query\Response\Results\Customers;

class CustomerName
{
    /** @var string */
    private $family;

    /** @var string */
    private $given;

    /** @var string */
    private $salutation;

    function __construct($family, $given, $salutation)
    {
        $this->family = $family;
        $this->given = $given;
        $this->salutation = $salutation;
    }

    /**
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @return string
     */
    public function getGiven()
    {
        return $this->given;
    }

    /**
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }
}
