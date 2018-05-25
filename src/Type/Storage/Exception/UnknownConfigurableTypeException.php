<?php declare(strict_types=1);

namespace Midnight\Block\Type\Storage\Exception;

use LogicException;

final class UnknownConfigurableTypeException extends LogicException
{
    public static function fromId(string $id): self
    {
        return new self(\sprintf('Unknown configurable type ID %s.', $id));
    }
}
