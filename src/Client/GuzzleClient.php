<?php namespace Mnel\Peach\Client;

use GuzzleHttp\Client as GuzzleHttpClient;
use Mnel\Peach\Client\GuzzleResponseFormatter;

class GuzzleClient implements Client
{
    /** @var GuzzleHttpClient */
    private $guzzle;
    /** @var GuzzleResponseFormatter */
    private $formatter;

    function __construct(GuzzleHttpClient $client, GuzzleResponseFormatter $formatter)
    {
        $this->guzzle = $client;
        $this->formatter = $formatter;
    }

    public function post($url, array $payload)
    {
        $response = $this->guzzle->post($url, [
            'body' => $payload
        ]);

        return $this->formatter->format($response);
    }
}
