<?php namespace Mnel\Peach\Commands\Queries;

use GuzzleHttp\Client;
use Mnel\Peach\Commands\Command;
use Mnel\Peach\Commands\CommandHandler;
use Mnel\Peach\Commands\Queries\QueryCommand;
use Mnel\Peach\Query\Response\ResponseException;

class QueryCommandHandler implements CommandHandler
{
    /** @var GuzzleClient */
    private $guzzle;

    /** @var QueryRequestTransformer */
    private $requestTransformer;

    /** @var QueryResponseTransformer */
    private $responseTransformer;

    public function __construct(Client $guzzle, QueryRequestTransformer $requestTransformer, QueryResponseTransformer $responseTransformer)
    {
        $this->guzzle = $guzzle;
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

        $guzzleResponse = $this->guzzle->post($request->getUrl(), ['body' => $payload]);

        $response = $this->responseTransformer->transform($guzzleResponse->xml()->asXML());

        if ($responseError = $response->getError()) {
            throw new ResponseException($responseError);
        }

        return $response;
    }
}
