<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use Midnight\Block\Exception\MissingAttributeException;
use Midnight\Block\Exception\UnknownAttributeException;
use Midnight\Block\Type\Attribute\AttributeInterface;

class BlockType implements BlockTypeInterface
{
    /** @var string */
    private $name;
    /** @var AttributeInterface[] */
    private $attributes = [];

    public function __construct(string $name, AttributeInterface ...$attributes)
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    /**
     * @return AttributeInterface[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @throws UnknownAttributeException
     */
    public function getAttribute(string $name): AttributeInterface
    {
        foreach ($this->attributes as $attribute) {
            if ($attribute->getName() === $name) {
                return $attribute;
            }
        }
        throw UnknownAttributeException::fromName($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string[] $values
     * @throws UnknownAttributeException
     * @throws MissingAttributeException
     */
    public function validateAttributeValues(array $values): void
    {
        foreach ($values as $name => $value) {
            $this->validateAttributeValue($name, $value);
        }
    }

    /**
     * @throws UnknownAttributeException
     */
    public function validateAttributeValue(string $name, ?string $value): void
    {
        $this->getAttribute($name)->validate($value);
    }
}
