<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\Certificate;

trait Certificates
{
    public function certificates($cn)
    {
        $url = 'certs';

        if ($cn) {
            $url += 'now/'.$cn;
        }

        return array_map(function ($attributes) {
            return new Certificate($attributes);
        }, $this->client->get($url)['certs']);
    }

    public function createCertificate($cn)
    {
        $this->client->post('now/certs', [
            'domains' => [$cn],
        ]);
    }

    public function renewCertificate($cn)
    {
        $this->client->post('now/certs', [
            'domains' => [$cn],
            'renew'   => true,
        ]);
    }

    public function replaceCertificate($cn, $cert, $key, $ca)
    {
        $this->client->put('now/certs', [
            'domains' => [$cn],
            'ca'      => $ca,
            'cert'    => $cert,
            'key'     => $key,
        ]);
    }

    public function deleteCertificate($cn)
    {
        $this->client->delete('now/certs/'.$cn);
    }
}
