<?php namespace Mnel\Peach\Commands\Queries;

use Mnel\Peach\Query\Request\QueryRequest;

interface QueryRequestTransformer
{
    public function transform(QueryRequest $request);
}
