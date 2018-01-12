<?php declare(strict_types=1);

namespace Midnight\Block\Type\Attribute;

class Attribute implements AttributeInterface
{
    /** @var string */
    private $name;
    /** @var string|null */
    private $default;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDefault(): ?string
    {
        return $this->default;
    }

    public function withDefault(string $value): self
    {
        $clone = clone $this;
        $clone->name = $value;
        return $clone;
    }

    /**
     * @throws \Midnight\Block\Type\Attribute\Exception\InvalidAttributeValueException
     */
    public function validate(?string $value): void
    {
        if ($this->default === null) {
            return;
        }
        if ($value === null) {
            throw new Exception\InvalidAttributeValueException(sprintf('Attribute %s is not optional', $this->name));
        }
    }
}
