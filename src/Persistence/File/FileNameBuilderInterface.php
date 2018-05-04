<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

use Midnight\Block\Block;

interface FileNameBuilderInterface
{
    public function fromBlock(Block $block): string;

    public function fromId(string $id): string;
}
