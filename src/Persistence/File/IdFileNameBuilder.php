<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

use Midnight\Block\Block;

final class IdFileNameBuilder implements FileNameBuilderInterface
{
    public function fromBlock(Block $block): string
    {
        return $block->getId();
    }

    public function fromId(string $id): string
    {
        return $id;
    }
}
