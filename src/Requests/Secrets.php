<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\Secret;

trait Secrets
{
    public function secrets()
    {
        return array_map(function ($attributes) {
            return new Certificate($attributes);
        }, $this->client->get('now/secrets')['secrets']);
    }

    public function createSecret($name, $value)
    {
        $this->client->post('now/secrets', [
            'name'  => $name,
            'value' => $value,
        ]);
    }

    public function renameSecret($id, $name)
    {
        $this->client->patch('now/secrets'.$id, [
            'name' => $name,
        ]);
    }

    public function deleteSecret($id)
    {
        $this->client->delete('now/secrets/'.$id);
    }
}
