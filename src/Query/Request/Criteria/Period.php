<?php namespace Mnel\Peach\Query\Request\Criteria;

/**
 * Specifies the date period of the query. The “from” date is always
 * extended with the time 00:00:00 and the “to” date with 23:59:59.
 * All times are UTC only.
 *
 * For the following payment types the “from” and “to” date can be any day:
 *  - Chargeback (CB)
 *  - Chargeback Reversal (CR)
 *  - Confirmation (CF)
 *  - Deregistration (DR)
 *  - Receipt (RC)
 *
 * For all other payment types the “from” and “to” date have to be on
 * the same day. This means only one day can be queried within one
 * XML query request.
 *
 * @package MnelPeach\Client\Request
 */
class Period
{
    /**
     * Date from when the query starts.
     *
     * @var string
     */
    private $from;

    /**
     * Date when the query ends.
     *
     * @var string
     */
    private $to;

    function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }
}
