<?php declare(strict_types=1);

namespace Midnight\Block\Type\Exception;

use LogicException;

final class MissingFieldValueException extends LogicException
{
    public static function fromFieldName(string $fieldName): self
    {
        return new self(\sprintf('The data array is missing a value for the "%s" field.', $fieldName));
    }
}
