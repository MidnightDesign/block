<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\Exception;

use RuntimeException;

final class UnknownBlockException extends RuntimeException
{
    public static function fromId(string $id): self
    {
        return new self(\sprintf('Unknown block ID %s.', $id));
    }
}
