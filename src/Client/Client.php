<?php namespace Mnel\Peach\Client;

interface Client
{
    /**
     * @param string $url
     * @param array  $payload
     * @return string
     */
    public function post($url, array $payload);
}
