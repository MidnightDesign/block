<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use Midnight\Block\Type\Attribute\AttributeInterface;

interface BlockTypeInterface
{
    public function getName(): string;

    /**
     * @return AttributeInterface[]
     */
    public function getAttributes(): array;

    public function getAttribute(string $name): AttributeInterface;

    /**
     * @param string[] $values
     */
    public function validateAttributeValues(array $values): void;

    public function validateAttributeValue(string $name, ?string $value);
}
