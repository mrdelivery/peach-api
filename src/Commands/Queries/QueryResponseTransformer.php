<?php namespace Mnel\Peach\Commands\Queries;

use GuzzleHttp\Message\ResponseInterface;
use Mnel\Peach\Query\Response\Response;

interface QueryResponseTransformer
{
    /**
     * @param string $response
     * @return Response
     */
    public function transform($response);
}
