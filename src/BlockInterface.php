<?php
declare(strict_types=1);

namespace Midnight\Block;

interface BlockInterface
{
    public function getId(): string;

    public function getAttribute(string $name): string;

    public function getTypeName(): string;
}
