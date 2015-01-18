<?php namespace Mnel\Peach\Query\Request\Criteria;

/**
 * TransactionType is an alternative and/or extension to the Methods group.
 * It allows you to define what types of transactions your query result
 * should contain.
 *
 * @package Mnel\Peach\Request\Criteria
 */
class TransactionType
{
    /**
     * Payment Transaction Types. Those are: CB, CD, CR, DB, CP, PA, RB, RC, RF and RV
     */
    const PAYMENT = 'PAYMENT';

    /**
     * Registration Transaction Types. Those are CF, DR, RG and RR
     */
    const REGISTER = 'REGISTER';

    /**
     * Scheduling Transaction Types. Those are DS, RS and SD
     */
    const SCHEDULE = 'SCHEDULE';

    /**
     * Risk Management Transaction Types. Those are EA, RI, 3D, SA, and IC.
     * This list is always extending as new features are implemented.
     */
    const RISK_MANAGEMENT = 'RISKMANAGEMENT';

    /** @var string */
    private $value;

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
}
