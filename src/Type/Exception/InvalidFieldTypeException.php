<?php declare(strict_types=1);

namespace Midnight\Block\Type\Exception;

use LogicException;

// @codeCoverageIgnoreStart
final class InvalidFieldTypeException extends LogicException
{
    public static function fromType(string $type): self
    {
        return new self(\sprintf('Invalid field type "%s".', $type));
    }
}
