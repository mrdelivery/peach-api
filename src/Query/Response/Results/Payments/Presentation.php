<?php namespace Mnel\Peach\Query\Response\Results\Payments;

class Presentation
{
    /** @var string */
    private $amount;

    /** @var string */
    private $currency;

    function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
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
}
