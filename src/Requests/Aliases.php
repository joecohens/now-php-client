<?php

namespace Joecohens\Now\Requests;

use Joecohens\Now\Resources\Alias;

trait Aliases
{
    public function aliases($id = null)
    {
        $url = '/now/aliases';

        if ($id) {
            $url = '/now/deployments/'.$id.'/aliases';
        }

        return array_map(function ($attributes) {
            return new Alias($attributes);
        }, $this->client->get($url)['aliases']);
    }

    public function createAlias($id, $alias)
    {
        $this->client->post('now/deployments/'.$id.'/aliases', [
            'alias' => $alias,
        ]);
    }

    public function deleteAlias($id)
    {
        $this->client->delete('now/aliases/'.$id);
    }
}
