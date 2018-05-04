<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

use Midnight\Block\Block;

interface BlockSerializerInterface
{
    public function serialize(Block $block): string;

    public function deserialize(string $serialized): Block;
}
