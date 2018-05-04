<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

use Midnight\Block\Block;

final class JsonBlockSerializer implements BlockSerializerInterface
{
    public function serialize(Block $block): string
    {
        return \json_encode($block->serialize());
    }

    public function deserialize(string $serialized): Block
    {
        return Block::deserialize(\json_decode($serialized, true));
    }
}
