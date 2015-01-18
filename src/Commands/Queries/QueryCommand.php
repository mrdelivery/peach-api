<?php namespace Mnel\Peach\Commands\Queries;

use Mnel\Peach\Commands\Command;
use Mnel\Peach\Query\Request\QueryRequest;

class QueryCommand extends Command
{
    /** @var QueryRequest */
    private $request;

    public function __construct(QueryRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return QueryRequest
     */
    public function getRequest()
    {
        return $this->request;
    }
}
