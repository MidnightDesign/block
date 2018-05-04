<?php declare(strict_types=1);

namespace Midnight\Block;

use Ramsey\Uuid\Uuid;

final class Block
{
    private const ID = 'id';
    private const DEFAULT_TYPE = 'default';
    private const TYPE = 'block_type';
    /** @var string */
    private $id;
    /** @var string */
    private $type;
    /** @var array */
    private $data = [];

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->type = self::DEFAULT_TYPE;
    }

    public static function deserialize(array $data): self
    {
        if (\array_key_exists(self::ID, $data)) {
            $block = self::withId($data[self::ID]);
            unset($data[self::ID]);
        } else {
            $block = new self();
        }
        if (\array_key_exists(self::TYPE, $data)) {
            $block = $block->withType($data[self::TYPE]);
            unset($data[self::TYPE]);
        }
        $block->data = $data;
        return $block;
    }

    public static function withId(string $id): self
    {
        $block = new Block();
        $block->id = $id;
        return $block;
    }

    public function withType(string $type): self
    {
        $clone = clone $this;
        $clone->type = $type;
        return $clone;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function withString(string $key, string $value): self
    {
        return $this->with($key, $value);
    }

    public function getString(string $key): ?string
    {
        return $this->data[$key] ?? null;
    }

    public function withArray(string $key, array $value): self
    {
        return $this->with($key, $value);
    }

    public function getArray(string $key): array
    {
        return $this->data[$key] ?? [];
    }

    public function serialize(): array
    {
        $data = $this->data;
        $data[self::ID] = $this->id;
        $data[self::TYPE] = $this->type;
        return $data;
    }

    public function equals(Block $block): bool
    {
        return $this->type === $block->type && $this->data === $block->data;
    }

    private function with(string $key, $value): Block
    {
        $clone = clone $this;
        $clone->data[$key] = $value;
        return $clone;
    }
}
