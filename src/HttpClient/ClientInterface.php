<?php

namespace Joecohens\Now\HttpClient;

interface ClientInterface
{
    public function getClient($apiKey);
    public function get($url);
    public function post($url, $payload = '');
    public function put($url, $payload = '');
    public function patch($url, $payload = '');
    public function delete($url, $payload = '');
}
