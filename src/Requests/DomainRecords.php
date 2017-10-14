<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\DomainRecord;

trait DomainRecords
{
    public function domainRecords($domain)
    {
        if (!$domain) {
            // Exeption
        }

        return array_map(function ($attributes) {
            return new DomainRecord($attributes);
        }, $this->client->get('domains/'.$domain.'/records')['records']);
    }

    public function addDomainRecord($domain, array $recordData = [])
    {
        if (!$domain) {
            // Exeption
        }

        $this->client->post('domains/'.$domain.'/records', $recordData);
    }

    public function deleteDomainRecord($domain, $recordId)
    {
        if (!$domain) {
            // Exeption
        }

        if (!$recordId) {
            // Exeption
        }

        $this->client->delete('domains/'.$domain.'/records/'.$recordId);
    }
}
