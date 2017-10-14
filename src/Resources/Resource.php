<?php

namespace Joecohens\Now\Resources;

class Resource
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    public $attributes;

    /**
     * Create a new resource instance.
     *
     * @param  array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;

        foreach ($this->attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
