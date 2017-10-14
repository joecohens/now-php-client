<?php

namespace Joecohens\Now\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Joecohens\Now\Exceptions\HttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClient
{
    protected $baseUrl = 'https://api.zeit.co/now/';
    protected $timeout = '30000';
    protected $client;

    public function getClient($apiKey)
    {
        $headers = [
            'Authorization' => 'Bearer: '.$apiKey,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ];

        if (version_compare(ClientInterface::VERSION, '6') === 1) {
            $this->client = new Client([
                'handler'  => $this->handler(),
                'base_uri' => $this->baseUrl,
                'timeout'  => $this->timeout,
                'headers'  => $headers,
            ]);
        } else {
            $this->client = new Client([
                'base_url' => $this->$baseUrl,
                'defaults' => [
                    'timeout'  => $this->timeout,
                    'headers' => $headers,
                ],
            ]);
        }

        return $this;
    }

    public function get($url)
    {
        return $this->request('GET', $url);
    }

    public function post($url, $payload = '')
    {
        return $this->request('POST', $url, $payload);
    }

    public function put($url, $payload = '')
    {
        return $this->request('PUT', $url, $payload);
    }

    public function patch($url, $payload = '')
    {
        return $this->request('PATCH', $url, $payload);
    }

    public function delete($url, $payload = '')
    {
        return $this->request('DELETE', $url, $payload);
    }

    protected function request($verb, $url, $payload = '')
    {
        try {
            $request = in_array($verb, ['GET', 'DELETE']) ? [] : $this->buildPayload($payload);

            $response = $this->client->{$verb}($url, $request);
        } catch (RequestException $e) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    protected function buildPayload($verb, $payload = '')
    {
        $options = [];

        $body = version_compare(ClientInterface::VERSION, '6') === 1 ? 'form_params' : 'body';

        $options[is_array($payload) ? 'json' : $body] = $payload;

        return $options;
    }

    protected function handleRequestError(ResponseInterface $response)
    {
        $body = (string) $response->getBody();
        $code = (int) $response->getStatusCode();

        $content = json_decode($body);

        throw new HttpException(isset($content->message) ? $content->message : 'Request not processed.', $code);
    }

    protected function handler()
    {
        $stack = HandlerStack::create();

        $stack->push(Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, TransferException $exception = null) {
            return $retries < 3 && ($exception instanceof ConnectException || ($response && $response->getStatusCode() >= 500) || in_array($response->getStatusCode(), [429], true));
        }, function ($retries) {
            return (int) pow(2, $retries) * 1000;
        }));

        return $stack;
    }
}
