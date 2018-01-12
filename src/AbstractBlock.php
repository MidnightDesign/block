<?php
declare(strict_types=1);

namespace Midnight\Block;

use Ramsey\Uuid\Uuid;

abstract class AbstractBlock implements BlockInterface
{
    /** @var string */
    private $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    public function getId(): string
    {
        return $this->id;
    }
}
