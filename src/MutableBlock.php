<?php
declare(strict_types=1);

namespace Midnight\Block;

use Midnight\Block\Type\BlockTypeInterface;
use Ramsey\Uuid\Uuid;

class MutableBlock implements MutableBlockInterface
{
    /** @var string */
    private $id;
    /** @var string[] */
    private $attributes = [];
    /** @var BlockTypeInterface */
    private $blockType;

    /**
     * @param string[] $attributes
     */
    public function __construct(BlockTypeInterface $blockType, array $attributes)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->blockType = $blockType;
        $blockType->validateAttributeValues($attributes);
        $this->attributes = $attributes;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @throws Exception\UnknownAttributeException
     */
    public function getAttribute(string $name): string
    {
        if (!isset($this->attributes[$name])) {
            throw Exception\UnknownAttributeException::fromName($name);
        }
        return $this->attributes[$name];
    }

    public function setAttribute(string $name, ?string $value): void
    {
        $this->blockType->validateAttributeValue($name, $value);
        if ($value === null) {
            unset($this->attributes['name']);
            return;
        }
        $this->attributes[$name] = $value;
    }

    public function getTypeName(): string
    {
        return $this->blockType->getName();
    }
}
