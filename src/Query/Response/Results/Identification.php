<?php namespace Mnel\Peach\Query\Response\Results;

class Identification
{
    /** @var string */
    private $shortId;

    /** @var string */
    private $uniqueId;

    /** @var string */
    private $transactionId;

    /** @var string */
    private $bulkId;

    /** @var string */
    private $invoiceId;

    function __construct($shortId, $uniqueId, $transactionId, $bulkId, $invoiceId)
    {
        $this->shortId = $shortId;
        $this->uniqueId = $uniqueId;
        $this->transactionId = $transactionId;
        $this->bulkId = $bulkId;
        $this->invoiceId = $invoiceId;
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
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @return string
     */
    public function getBulkId()
    {
        return $this->bulkId;
    }

    /**
     * @return string
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }
}
