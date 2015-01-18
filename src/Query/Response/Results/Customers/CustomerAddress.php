<?php namespace Mnel\Peach\Query\Response\Results\Customers;

class CustomerAddress
{
    /** @var string */
    private $street;

    /** @var string */
    private $city;

    /** @var string */
    private $state;

    /** @var string */
    private $country;

    /** @var int */
    private $zip;

    function __construct($street, $city, $state, $country, $zip)
    {
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return int
     */
    public function getZip()
    {
        return $this->zip;
    }
}
