<?php declare(strict_types=1);

namespace Midnight\Block\Persistence;

use Midnight\Block\Block;

interface BlockStorageInterface
{
    public function persist(Block ...$blocks): void;
}
