<?php namespace Mnel\Peach\Query\Request\Criteria;

class QueryLevel
{
    /**
     * Transactions are queried on channel level.
     * (ID specified with entity is a channel ID)
     */
    const CHANNEL = 'CHANNEL';

    /**
     * Transactions are queried on merchant level.
     * (ID specified with entity is a merchant ID)
     */
    const MERCHANT = 'MERCHANT';

    /**
     * Transactions are queried on PSP level.
     * (ID specified with entity is a PSP ID)
     */
    const PSP = 'PSP';

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
