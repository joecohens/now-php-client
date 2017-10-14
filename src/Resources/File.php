<?php

namespace Joecohens\Now\Resources;

class File extends Resource
{
    /**
     * The file uid.
     *
     * @var string
     */
    public $uid;

    /**
     * The file name.
     *
     * @var string
     */
    public $name;

    /**
     * The file mode.
     *
     * @var int
     */
    public $mode;

    /**
     * The file type.
     *
     * @var string
     */
    public $type;
}
