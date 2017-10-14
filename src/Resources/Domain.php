<?php

namespace Joecohens\Now\Resources;

class Domain extends Resource
{
    /**
     * The domain uid.
     *
     * @var string
     */
    public $uid;

    /**
     * The domain name.
     *
     * @var string
     */
    public $name;

    /**
     * The domain verified.
     *
     * @var bool
     */
    public $verified;

    /**
     * The domain is external.
     *
     * @var bool
     */
    public $isExternal;

    /**
     * The domain bought at.
     *
     * @var string
     */
    public $boughtAt;

    /**
     * The domain expires at.
     *
     * @var string
     */
    public $expiresAt;

    /**
     * The domain created.
     *
     * @var string
     */
    public $created;

    /**
     * The domain created.
     *
     * @var array
     */
    public $aliases;

    /**
     * The domain created.
     *
     * @var array
     */
    public $certs;
}
