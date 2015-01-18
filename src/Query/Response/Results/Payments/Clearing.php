<?php namespace Mnel\Peach\Query\Response\Results\Payments;

class Clearing
{
    /** @var string */
    private $amount;

    /** @var string */
    private $currency;

    /** @var string */
    private $descriptor;

    /** @var string */
    private $fxRate;

    /** @var string */
    private $fxSource;

    /** @var string */
    private $fxDate;

    function __construct($amount, $currency, $descriptor, $fxRate, $fxSource, $fxDate)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->descriptor = $descriptor;
        $this->fxRate = $fxRate;
        $this->fxSource = $fxSource;
        $this->fxDate = $fxDate;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getDescriptor()
    {
        return $this->descriptor;
    }

    /**
     * @return string
     */
    public function getFxRate()
    {
        return $this->fxRate;
    }

    /**
     * @return string
     */
    public function getFxSource()
    {
        return $this->fxSource;
    }

    /**
     * @return string
     */
    public function getFxDate()
    {
        return $this->fxDate;
    }
}
