<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use Midnight\Block\Block;

final class ConfigurableType
{
    private const TYPE = 'configurable';
    private const TEMPLATE = 'template';

    /** @var Field[] */
    private $fields = [];

    public static function extractTemplate(Block $block): string
    {
        return $block->getString(self::TEMPLATE);
    }

    public static function injectTemplate(Block $block, string $template): Block
    {
        return $block->withString(self::TEMPLATE, $template);
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
}
