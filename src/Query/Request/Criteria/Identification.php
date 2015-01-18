<?php namespace Mnel\Peach\Query\Request\Criteria;

/**
 * Contains IDs which are used for the identification of the transaction.
 *
 * @package Mnel\Peach\Request\Criteria
 */
class Identification
{
    /**
     * Only ID where the uniqueness within the system is
     * absolutely guaranteed. Has to be used for all
     * automated matching and reference purposes
     *
     * @var array|string[]
     */
    protected $uniqueIDs;

    /**
     * ID which is used for manual entry and search purposes.
     * The likelihood for uniqueness is very high, but not
     * guaranteed.
     *
     * @var array
     */
    protected $shortId;

    /**
     * ID the merchant has assigned to a specific
     * payment transaction and submitted with
     * the original payment transaction.
     *
     * @var string
     */
    protected $transactionId;

    function __construct(array $uniqueIDs = [], $shortId = null, $transactionId = null)
    {
        $this->uniqueIDs = $uniqueIDs;
        $this->shortId = $shortId;
        $this->transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getUniqueIDs()
    {
        return $this->uniqueIDs;
    }

    /**
     * @return string
     */
    public function getShortId()
    {
        return $this->shortId;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }
}
