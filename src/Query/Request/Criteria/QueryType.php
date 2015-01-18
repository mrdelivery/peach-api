<?php namespace Mnel\Peach\Query\Request\Criteria;

class QueryType
{
    /**
     * No special behavior activated.
     * This is the default type.
     */
    const STANDARD = 'STANDARD';

    /**
     * Queries all transactions which match the given
     * query parameters and which are active
     * transactions of their sessions.
     */
    const ACTIVE_TRANSACTIONS = 'ACTIVE_TRANSACTIONS';

    /**
     * Queries all transactions which are linked directly
     * or indirectly to one specific transaction.
     * For this type the ID or ShortID of one
     * transaction must be specified.
     */
    const LINKED_TRANSACTIONS = 'LINKED_TRANSACTIONS';

    /**
     * Queries all transactions which match the given
     * query parameters and which are available
     * transactions of their sessions.
     *
     * The difference between ACTIVE_TRANSACTIONS and AVAILABLE_TRANSACTIONS applies to registrations only:
     * “active” are only confirmed registrations,
     * “available” are not confirmed registrations also.
     */
    const AVAILABLE_TRANSACTIONS = 'AVAILABLE_TRANSACTIONS';

    /**
     * Queries all transactions which are linked directly or indirectly
     * to one specific transaction and which are active transactions
     * in their session. For this type the ID or ShortID of one
     * transaction must be specified.
     */
    const ACTIVE_LINKED_TRANSACTIONS = 'ACTIVE_LINKED_TRANSACTIONS';

    /**
     * Queries all transactions which are linked directly or indirectly
     * to one specific transaction and which are active transactions
     * in their session. For this type the ID or ShortID of one
     * transaction must be specified.
     *
     * The difference between ACTIVE_LINKED_TRANSACTIONS and AVAILABLE_LINKED_TRANSACTIONS
     * applies to registrations only:
     *      “active” are only confirmed registrations,
     *      “available” are not confirmed registrations also.
     */
    const AVAILABLE_LINKED_TRANSACTIONS = 'AVAILABLE_LINKED_TRANSACTIONS';
}
