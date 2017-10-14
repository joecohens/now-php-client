<?php

namespace Joecohens\Now;

use Joecohens\Now\HttpClient\ClientInterface;
use Joecohens\Now\HttpClient\GuzzleHttpClient;
use Joecohens\Now\Requests\Aliases;
use Joecohens\Now\Requests\Certificates;
use Joecohens\Now\Requests\Deployments;
use Joecohens\Now\Requests\DomainRecords;
use Joecohens\Now\Requests\Domains;
use Joecohens\Now\Requests\Files;
use Joecohens\Now\Requests\Secrets;

class Now
{
    use Aliases,
        Certificates,
        Deployments,
        Domains,
        DomainRecords,
        Files,
        Secrets;

    /**
     * The client instance.
     *
     * @var \Joecohens\Now\HttpClient\ClientInterface
     */
    protected $client;

    /**
     * Create a new Now instance.
     *
     * @param string                                         $apiKey
     * @param string                                         $teamId
     * @param \Joecohens\Now\HttpClient\ClientInterface|null $client
     */
    public function __construct($apiKey, $teamId = null, ClientInterface $client = null)
    {
        $this->client = $client
            ? $client->getClient($apiKey, $teamId)
            : (new GuzzleHttpClient())->getClient($apiKey, $teamId);
    }
}
