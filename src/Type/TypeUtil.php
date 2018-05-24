<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use Midnight\Block\Block;
use Midnight\Block\Exception\MissingPropertyException;

final class TypeUtil
{
    /**
     * @throws MissingPropertyException
     */
    public static function forceGetString(Block $block, string $property): string
    {
        $videoId = $block->getString($property);
        if ($videoId === null) {
            throw MissingPropertyException::fromProperty($property);
        }
        return $videoId;
    }
}
