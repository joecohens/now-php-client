<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\File;

trait Files
{
    public function files($id)
    {
         if (!$id) {
            // Exeption
        }

        return array_map(function ($attributes) {
            return new File($attributes);
        }, $this->client->get('deployments/'.$id.'/files'));
    }

    public function file($id, $fileId)
    {
        if (!$id) {
            // Exeption
        }

        if (!$fileId) {
            // Exeption
        }

        return new File(['content' => $this->client->get('deployments/'.$id.'/files/'.$fileId)]);
    }
}
