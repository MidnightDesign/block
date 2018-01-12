<?php declare(strict_types=1);

namespace Midnight\Block\Exception;

use LogicException;

class UnknownAttributeException extends LogicException
{
    public static function fromName(string $name): self
    {
        return new self(\sprintf('Unknown attribute "%s".', $name));
    }
}
