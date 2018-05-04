<?php declare(strict_types=1);

namespace Midnight\Block\Exception;

use LogicException;

final class MissingPropertyException extends LogicException
{
    public static function fromProperty(string $property): self
    {
        return new self(sprintf('Missing property "%s" on block.', $property));
    }
}
