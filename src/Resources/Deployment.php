<?php

namespace Joecohens\Now\Resources;

class Deployment extends Resource
{
    /**
     * The deployment uid.
     *
     * @var string
     */
    public $uid;

    /**
     * The deployment name.
     *
     * @var string
     */
    public $name;

    /**
     * The deployment url.
     *
     * @var string
     */
    public $url;

    /**
     * The deployment host.
     *
     * @var string
     */
    public $host;

    /**
     * The deployment state.
     *
     * @var string
     */
    public $state;

    /**
     * The deployment stateTs.
     *
     * @var string
     */
    public $stateTs;

    /**
     * The deployment scale.
     *
     * @var int
     */
    public $scale;

    /**
     * The deployment type.
     *
     * @var string
     */
    public $type;

    /**
     * The deployment created.
     *
     * @var int
     */
    public $created;
}
