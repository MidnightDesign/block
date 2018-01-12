<?php
declare(strict_types=1);

namespace Midnight\Block;

abstract class AbstractBlock implements BlockInterface
{
    /** @var string */
    private $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }
}
