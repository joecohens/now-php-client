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
        if (!$cn) {
            // Exeption
        }

        $this->client->post('now/certs', [
            'domains' => [$cn],
        ]);
    }

    public function renewDeployment($cn)
    {
        if (!$cn) {
            // Exeption
        }

        $this->client->post('now/certs', [
            'domains' => [$cn],
            'renew'   => true
        ]);
    }

    public function replaceCertificate($cn, $cert, $key, $ca)
    {
        if (!$cn) {
            // Exeption
        }

        $this->client->put('now/certs', [
            'domains' => [$cn],
            'ca'      => $ca,
            'cert'    => $cert,
            'key'     => $key,
        ]);
    }

    public function deleteCertificate($cn)
    {
        if (!$cn) {
            // Exeption
        }

        $this->client->delete('now/certs/'.$cn);
    }
}
