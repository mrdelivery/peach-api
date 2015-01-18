<?php namespace Mnel\Peach\Query\Response\Results;

class Account
{
    /** @var string */
    private $number;

    /** @var string */
    private $holder;

    /** @var string */
    private $brand;

    /** @var string */
    private $month;

    /** @var string */
    private $year;

    /** @var string */
    private $registrationId;

    /** @var string */
    private $expiryMonth;

    /** @var string */
    private $expiryYear;

    function __construct($number, $holder, $brand, $month, $year, $registrationId, $expiryMonth, $expiryYear)
    {
        $this->number = $number;
        $this->holder = $holder;
        $this->brand = $brand;
        $this->month = $month;
        $this->year = $year;
        $this->registrationId = $registrationId;
        $this->expiryMonth = $expiryMonth;
        $this->expiryYear = $expiryYear;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getHolder()
    {
        return $this->holder;
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
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getRegistrationId()
    {
        return $this->registrationId;
    }

    /**
     * @return string
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * @return string
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }
}
