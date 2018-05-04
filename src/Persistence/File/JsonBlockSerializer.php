<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

use Midnight\Block\Block;
use Midnight\Block\Persistence\File\Exception\SerializationException;

final class JsonBlockSerializer implements BlockSerializerInterface
{
    public function serialize(Block $block): string
    {
        return \json_encode($block->serialize());
    }

    public function deserialize(string $serialized): Block
    {
        $data = \json_decode($serialized, true);
        if ($data === null) {
            throw new SerializationException(\json_last_error_msg());
        }
        return Block::deserialize($data);
    }
}
