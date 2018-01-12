<?php declare(strict_types=1);

namespace Midnight\Block\Persistence;

use Midnight\Block\BlockInterface;

interface BlockPersisterInterface
{
    public function persist(BlockInterface $block): void;
}
