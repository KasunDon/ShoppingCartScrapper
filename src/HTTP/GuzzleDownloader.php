<?php

namespace HTTP;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * Guzzle 6 Client 
 */
class GuzzleDownloader implements DownloaderInterface
{
    /**
     * @var GuzzleHttp\Client
     */
    private $client;
    
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * downloads content of given uri
     * 
     * @param string $uri
     * @return string
     */
    public function download($uri)
    {
        $request = new Request('GET', $uri);
        $response = $this->client->send($request);
        $body = (string) $response->getBody();

        return $body;
    }
}
