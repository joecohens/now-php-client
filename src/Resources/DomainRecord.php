<?php

namespace Joecohens\Now\Resources;

class DomainRecord extends Resource
{
    /**
     * The domain record uid.
     *
     * @var string
     */
    public $uid;

    /**
     * The domain record name.
     *
     * @var string
     */
    public $name;

    /**
     * The domain record slug.
     *
     * @var string
     */
    public $slug;

    /**
     * The domain record type.
     *
     * @var string
     */
    public $type;

    /**
     * The domain record value.
     *
     * @var string
     */
    public $value;

    /**
     * The domain record created.
     *
     * @var string
     */
    public $created;

    /**
     * The domain record updated.
     *
     * @var string
     */
    public $updated;
}
