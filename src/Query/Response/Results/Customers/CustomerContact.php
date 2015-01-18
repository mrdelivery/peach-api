<?php namespace Mnel\Peach\Query\Response\Results\Customers;

class CustomerContact
{
    /** @var string */
    private $email;

    /** @var string */
    private $ip;

    /** @var string */
    private $mobile;

    /** @var string */
    private $phone;

    function __construct($email, $ip, $mobile, $phone)
    {
        $this->email = $email;
        $this->ip = $ip;
        $this->mobile = $mobile;
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}
