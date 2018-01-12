<?php declare(strict_types=1);

namespace Midnight\Block;

interface MutableBlockInterface extends BlockInterface
{
    public function setAttribute(string $name, ?string $value): void;
}
