<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\DomainRecord;

trait DomainRecords
{
    public function domainRecords($domain)
    {
        return array_map(function ($attributes) {
            return new DomainRecord($attributes);
        }, $this->client->get('domains/'.$domain.'/records')['records']);
    }

    public function addDomainRecord($domain, array $recordData = [])
    {
        $this->client->post('domains/'.$domain.'/records', $recordData);
    }

    public function deleteDomainRecord($domain, $recordId)
    {
        $this->client->delete('domains/'.$domain.'/records/'.$recordId);
    }
}
