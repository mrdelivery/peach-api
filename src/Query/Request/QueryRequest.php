<?php namespace Mnel\Peach\Query\Request;

use Mnel\Peach\Query\Request\Criteria\QueryMode;

class QueryRequest
{
    const VERSION_1 = '1.0';

    /** @var string */
    private $version = self::VERSION_1;

    /** @var Header */
    private $header;

    /** @var Query */
    private $query;

    /** @var array|string[] */
    private $queryModeUrls = [
        QueryMode::LIVE            => 'https://ctpe.net/payment/query',
        QueryMode::INTEGRATOR_TEST => 'https://test.ctpe.net/payment/query',
        QueryMode::CONNECTOR_TEST  => 'https://test.ctpe.net/payment/query',
    ];

    function __construct(Header $header, Query $query)
    {
        $this->header = $header;
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        $mode = $this->getQuery()->getMode();

        return $this->queryModeUrls[ $mode ];
    }


    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }
}
