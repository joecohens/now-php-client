<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\File;
use Joecohens\Now\Resources\FileContent;

trait Files
{
    public function files($id)
    {
        return array_map(function ($attributes) {
            return new File($attributes);
        }, $this->client->get('deployments/'.$id.'/files'));
    }

    public function file($id, $fileId)
    {
        return new FileContent(['content' => $this->client->get('deployments/'.$id.'/files/'.$fileId)]);
    }
}
