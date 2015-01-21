<?php namespace Mnel\Peach\Client;

use GuzzleHttp\Message\ResponseInterface;

interface GuzzleResponseFormatter
{
    /**
     * @param ResponseInterface $clientResponse
     * @return string
     */
    public function format(ResponseInterface $clientResponse);
}
