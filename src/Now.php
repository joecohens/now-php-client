<?php

namespace Joecohens\Now;

use Joecohens\Now\HttpClient\ClientInterface;
use Joecohens\Now\HttpClient\GuzzleHttpClient;
use Joecohens\Now\Requests\Deployments;

class Now
{
    use Deployments;

    protected $apiKey;
    protected $client;

    public function __construct($apiKey, ClientInterface $client = null)
    {
        $this->apiKey = $apiKey;

        $this->client = $client ?: (new GuzzleHttpClient())->getClient($apiKey);
    }
}
