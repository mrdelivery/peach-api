<?php namespace Mnel\Peach\Query\Request\Criteria;

class User
{
    /**
     * The login is a unique ID for each human or system user. Each merchant
     * or payment service provider can have several logins for system users
     * and human users. It is not recommended to share one login between
     * several human users.
     *
     * @var string
     */
    protected $login;

    /**
     * A password which fits the login UID has to be provided.
     * It is distributed together with the login UID.
     *
     * @var string
     */
    protected $password;

    function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

}
