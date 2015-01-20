<?php namespace Mnel\Peach\Query\Request\Criteria;

class ProcessingResult
{
    /**
     * Get successful Transactions only
     */
    const ACK = 'ACK';

    /**
     * Get failed (rejected) Transactions only
     */
    const NOK = 'NOK';

    /** @var string */
    private $value;

    /**
     * @param string $value
     */
    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
