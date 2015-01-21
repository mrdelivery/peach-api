<?php namespace Mnel\Peach\Client;

use GuzzleHttp\Message\ResponseInterface;

class XmlGuzzleResponseFormatter implements GuzzleResponseFormatter
{
    public function format(ResponseInterface $clientResponse)
    {
        return $clientResponse->xml()->asXML();
    }
}
