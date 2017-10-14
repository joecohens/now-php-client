<?php

namespace Joecohens\Now\Resources;

class Certificate extends Resource
{
    /**
     * The certificate uid.
     *
     * @var string
     */
    public $uid;

    /**
     * The certificate cn.
     *
     * @var string
     */
    public $cn;

    /**
     * The certificate autoRenew.
     *
     * @var string
     */
    public $autoRenew;

    /**
     * The certificate expiration.
     *
     * @var string
     */
    public $expiration;

    /**
     * The certificate created.
     *
     * @var string
     */
    public $created;
}
