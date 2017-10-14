<?php

namespace Joecohens\Now\HttpClient;

interface ClientInterface
{
    /**
     * Get a client instance.
     *
     * @param string $apiKey
     *
     * @return mixed
     */
    public function getClient($apiKey);

    /**
     * Make a get request.
     *
     * @param string $url
     *
     * @throws \Joecohens\Now\Exceptions\HttpException
     *
     * @return mixed
     */
    public function get($url);

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
    public function post($url, $payload = '');

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
    public function put($url, $payload = '');

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
    public function patch($url, $payload = '');

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
    public function delete($url, $payload = '');
}
