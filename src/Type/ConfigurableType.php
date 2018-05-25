<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use Midnight\Block\Block;
use Midnight\Block\Exception\MissingPropertyException;
use Ramsey\Uuid\Uuid;

final class ConfigurableType
{
    private const TYPE = 'configurable';
    private const TEMPLATE = 'template';
    private const ID = 'id';
    private const FIELDS = 'fields';

    /** @var string */
    private $id;
    /** @var Field[] */
    private $fields = [];

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * @throws MissingPropertyException
     */
    public static function extractTemplate(Block $block): string
    {
        return TypeUtil::forceGetString($block, self::TEMPLATE);
    }

    public static function injectTemplate(Block $block, string $template): Block
    {
        return $block->withString(self::TEMPLATE, $template);
    }

    public static function deserialize(array $data): self
    {
        $type = new self();
        $type->id = $data[self::ID];
        $type->fields = \array_map([Field::class, 'deserialize'], $data[self::FIELDS]);
        return $type;
    }

    private static function serializeField(Field $field): array
    {
        return $field->serialize();
    }

    /**
     * @throws \LogicException
     */
    public function create(array $data): Block
    {
        $block = (new Block())
            ->withString(self::TEMPLATE, '')
            ->withType(self::TYPE);
        foreach ($this->fields as $field) {
            $block = $field->setBlockValue($block, $data);
        }
        return $block;
    }

    public function addField(Field $field): void
    {
        $this->fields[] = $field;
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function removeField(Field $field): void
    {
        $this->fields = \array_filter($this->fields, function (Field $attachedField) use ($field): bool {
            return $attachedField->getName() !== $field->getName();
        });
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function serialize(): array
    {
        $serializedFields = \array_map([self::class, 'serializeField'], $this->fields);
        return [
            self::ID => $this->id,
            self::FIELDS => $serializedFields,
        ];
    }
}
