<?php namespace Mnel\Peach\Query\Request\Criteria;

class QueryMode
{
    /**
     * Transaction gets just sent to the Integrator and not to the
     * Validator (Risk Management) or Connector modules.  Used
     * to test compliance against the Integrator module.
     */
    const INTEGRATOR_TEST = 'INTEGRATOR_TEST';

    /**
     * Transaction enters the Integrator module, accesses the
     * Validator modules (Risk Management) and then goes to
     * the Connector. The Connector operates in test mode.
     */
    const CONNECTOR_TEST = 'CONNECTOR_TEST';

    /**
     * Transaction enters the Integrator module, accesses the Validator
     * modules (Risk Management) and then goes to the Connector.
     * The Connector operates in live mode.
     */
    const LIVE = 'LIVE';

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
