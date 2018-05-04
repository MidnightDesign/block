<?php declare(strict_types=1);

namespace Midnight\Block\View\Exception;

use LogicException;

final class UnknownBlockTypeException extends LogicException
{
    public static function fromType(string $type): self
    {
        return new self(\sprintf('Unknown block type "%s".', $type));
    }
}
