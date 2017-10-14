<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\Domain;

trait Domains
{
    public function domains()
    {
        return array_map(function ($attributes) {
            return new Domain($attributes);
        }, $this->client->get('domains')['domains']);
    }

    public function addDomain($name, $isExternalDNS = false)
    {
        if (!$name) {
            // Exeption
        }

        $this->client->post('domains', [
            'name'       => $name,
            'isExternal' => $isExternalDNS,
        ]);
    }

    public function deleteDomain($name)
    {
        if (!$name) {
            // Exeption
        }

        $this->client->delete('domains/'.$name);
    }
}
