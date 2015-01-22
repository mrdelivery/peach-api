<?php namespace Mnel\Peach\Query\Response\Results\Customers;

class Customer
{
    /** @var CustomerAddress */
    private $address;

    /** @var CustomerContact */
    private $contact;

    /** @var CustomerName */
    private $name;

    function __construct(CustomerAddress $address, CustomerContact $contact, CustomerName $name)
    {
        $this->address = $address;
        $this->contact = $contact;
        $this->name = $name;
    }

    /**
     * @return CustomerAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return CustomerContact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @return CustomerName
     */
    public function getName()
    {
        return $this->name;
    }
}
