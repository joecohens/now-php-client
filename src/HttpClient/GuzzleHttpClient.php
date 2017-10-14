<?php

namespace Joecohens\Now\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Joecohens\Now\Exceptions\HttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClient
{
    /**
     * The base api url.
     *
     * @var string
     */
    protected $baseUrl = 'https://api.zeit.co/now/';

    /**
     * The default request timeout.
     *
     * @var string
     */
    protected $timeout = '30000';

    /**
     * The Guzzle client instance.
     *
     * @var \GuzzleHttp\Client
     */
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
                    'headers'  => $headers,
                ],
            ]);
        }

        return $this;
    }

    /**
     * Make a get request.
     *
     * @param string $url
     *
     * @throws \Joecohens\Now\Exceptions\HttpException
     *
     * @return mixed
     */
    public function get($url)
    {
        return $this->request('GET', $url);
    }

    /**
     * Make a post request.
     *
     * @param string       $url
     * @param string|array $payload
     *
     * @throws \Joecohens\Now\Exceptions\HttpException
     *
     * @return array
     */
    public function post($url, $payload = '')
    {
        return $this->request('POST', $url, $payload);
    }

    /**
     * Make a put request.
     *
     * @param string       $url
     * @param string|array $payload
     *
     * @throws \Joecohens\Now\Exceptions\HttpException
     *
     * @return array
     */
    public function put($url, $payload = '')
    {
        return $this->request('PUT', $url, $payload);
    }

    /**
     * Make a patch request.
     *
     * @param string       $url
     * @param string|array $payload
     *
     * @throws \Joecohens\Now\Exceptions\HttpException
     *
     * @return array
     */
    public function patch($url, $payload = '')
    {
        return $this->request('PATCH', $url, $payload);
    }

    /**
     * Make a delete request.
     *
     * @param string       $url
     * @param string|array $payload
     *
     * @throws \Joecohens\Now\Exceptions\HttpException
     *
     * @return array
     */
    public function delete($url, $payload = '')
    {
        return $this->request('DELETE', $url, $payload);
    }

    /**
     * Make request with Guzzle.
     *
     * @param string       $verb
     * @param string       $url
     * @param string|array $payload
     *
     * @return mixed
     */
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

    /**
     * Build payload for request.
     *
     * @param string|array $payload
     *
     * @return array
     */
    protected function buildPayload($payload = '')
    {
        $options = [];

        $body = version_compare(ClientInterface::VERSION, '6') === 1 ? 'form_params' : 'body';

        $options[is_array($payload) ? 'json' : $body] = $payload;

        return $options;
    }

    /**
     * Handle request error.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @throws \Joecohens\Now\Exceptions\HttpException
     *
     * @return void
     */
    protected function handleRequestError(ResponseInterface $response)
    {
        $body = (string) $response->getBody();
        $code = (int) $response->getStatusCode();

        $content = json_decode($body);

        throw new HttpException(isset($content->message) ? $content->message : 'Request not processed.', $code);
    }

    /**
     * Create a Guzzle 6 middleware handler.
     *
     * @return \GuzzleHttp\HandlerStack
     */
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
