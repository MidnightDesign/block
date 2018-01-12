<?php
declare(strict_types=1);

namespace Midnight\Block;

interface BlockInterface
{
    /**
     * @return string|null
     */
    public function getId(): ?string;

    /**
     * @param string $id
     *
     * @return void
     */
    public function setId(string $id): void;
}
