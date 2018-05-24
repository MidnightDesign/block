<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use LogicException;
use Midnight\Block\Block;

final class Field
{
    private const STRING = 'string';
    private const ARRAY = 'array';
    private const TYPES = [self::STRING, self::ARRAY];
    /** @var string */
    private $type;
    /** @var string */
    private $name;
    /** @var bool */
    private $isRequired = false;

    /**
     * @throws Exception\InvalidFieldTypeException
     */
    private function __construct(string $type, string $name)
    {
        $this->setType($type);
        $this->name = $name;
    }

    /**
     * @throws Exception\InvalidFieldTypeException
     */
    public static function string(string $name): self
    {
        return new self(self::STRING, $name);
    }

    /**
     * @throws Exception\InvalidFieldTypeException
     */
    public static function array(string $name): self
    {
        return new self(self::ARRAY, $name);
    }

    private static function isValidType(string $type): bool
    {
        return \in_array($type, self::TYPES, true);
    }

    /**
     * @throws LogicException
     * @throws Exception\MissingFieldValueException
     */
    public function setBlockValue(Block $block, array $data): Block
    {
        if (!isset($data[$this->name])) {
            if ($this->isRequired) {
                throw Exception\MissingFieldValueException::fromFieldName($this->name);
            }
            return $block;
        }
        $value = $data[$this->name];
        switch ($this->type) {
            case self::STRING:
                return $block->withString($this->name, $value);
            case self::ARRAY:
                return $block->withArray($this->name, $value);
        }
        throw new LogicException(sprintf('Unknown field type "%s".', $this->type)); // @codeCoverageIgnore
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function required(): self
    {
        $clone = clone $this;
        $clone->isRequired = true;
        return $clone;
    }

    /**
     * @throws Exception\InvalidFieldTypeException
     */
    private function setType(string $type): void
    {
        if (!self::isValidType($type)) {
            throw Exception\InvalidFieldTypeException::fromType($type); // @codeCoverageIgnore
        }
        $this->type = $type;
    }
}