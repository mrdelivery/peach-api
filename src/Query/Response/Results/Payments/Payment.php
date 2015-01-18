<?php namespace Mnel\Peach\Query\Response\Results\Payments;

class Payment
{
    /** @var string */
    private $code;

    /** @var Clearing */
    private $clearing;

    function __construct($code, Clearing $clearing, Presentation $presentation)
    {
        $this->code = $code;
        $this->clearing = $clearing;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return Clearing
     */
    public function getClearing()
    {
        return $this->clearing;
    }
}
