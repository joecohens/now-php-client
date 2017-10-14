<?php

namespace Joecohens\Now;

use Joecohens\Now\HttpClient\ClientInterface;
use Joecohens\Now\HttpClient\GuzzleHttpClient;
use Joecohens\Now\Requests\Certificates;
use Joecohens\Now\Requests\Deployments;
use Joecohens\Now\Requests\Domains;
use Joecohens\Now\Requests\DomainRecords;
use Joecohens\Now\Requests\Files;

class Now
{
    use Certificates;
    use Deployments;
    use Domains;
    use DomainRecords;
    use Files;

    protected $apiKey;
    protected $client;

    public function __construct($apiKey, ClientInterface $client = null)
    {
        $this->apiKey = $apiKey;

        $this->client = $client ?: (new GuzzleHttpClient())->getClient($apiKey);
    }
}
