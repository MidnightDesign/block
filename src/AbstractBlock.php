<?php

namespace Midnight\Block;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class AbstractBlock implements BlockInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return (string)$this->id;
    }
}
