<?php namespace Mnel\Peach\Commands\Queries;

use Mnel\Peach\Client\Client;
use Mnel\Peach\Commands\Command;
use Mnel\Peach\Commands\CommandHandler;
use Mnel\Peach\Commands\Queries\QueryCommand;
use Mnel\Peach\Query\Response\ResponseException;

class QueryCommandHandler implements CommandHandler
{
    /** @var Client */
    private $client;

    /** @var QueryRequestTransformer */
    private $requestTransformer;

    /** @var QueryResponseTransformer */
    private $responseTransformer;

    public function __construct(Client $client, QueryRequestTransformer $requestTransformer, QueryResponseTransformer $responseTransformer)
    {
        $this->client = $client;
        $this->requestTransformer = $requestTransformer;
        $this->responseTransformer = $responseTransformer;
    }

    /**
     * @param Command $command
     * @return \Mnel\Peach\Query\Response\Response
     * @throws ResponseException
     */
    public function handle(Command $command)
    {
        return $this->process($command);
    }

    /**
     * @param QueryCommand $command
     * @return \Mnel\Peach\Query\Response\Response
     * @throws ResponseException
     */
    public function process(QueryCommand $command)
    {
        $request = $command->getRequest();

        $payload = $this->requestTransformer->transform($request);

        $responseData = $this->client->post($request->getUrl(), $payload);

        $response = $this->responseTransformer->transform($responseData);

        if ($responseError = $response->getError()) {
            throw new ResponseException($responseError, $command, $response->getRawResponse());
        }

        return $response;
    }
}
