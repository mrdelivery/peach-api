<?php namespace Mnel\Peach\Query\Request\Criteria;

/**
 * Allows you to search for a user account. This is only
 * needed if you search for registered user accounts.
 *
 * @package Mnel\Peach\Request\Criteria
 */
class Account
{
    /**
     * ID of the user with the User Account.
     *
     * @var string
     */
    private $id;

    /**
     * Brand of the User Account.
     *
     * @var string
     */
    private $brand;

    /**
     * Password of the registered user.
     *
     * @var string
     */
    private $password;

    function __construct($id, $brand, $password)
    {
        $this->id = $id;
        $this->brand = $brand;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
