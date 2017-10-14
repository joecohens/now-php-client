<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\Deployment;

trait Deployments
{
    public function deployments()
    {
        return array_map(function ($attributes) {
            return new Deployment($attributes);
        }, $this->client->get('deployments')['deployments']);
    }

    public function deployment($id)
    {
        if (!$id) {
            // Exeption
        }

        return new Deployment($this->client->get('deployments/'.$id));
    }

    public function createDeployment($body)
    {
        if (!$body) {
            // Exeption
        }

        return new Deployment($this->client->post('deployments', $body)['deployment']);
    }

    public function deleteDeployment($id)
    {
        if (!$id) {
            // Exeption
        }

        $this->client->delete('deployments/'.$id);
    }
}
