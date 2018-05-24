<?php declare(strict_types=1);

namespace Midnight\Test\Block\Type;

use Midnight\Block\Type\ConfigurableType;
use Midnight\Block\Type\Field;
use PHPUnit\Framework\TestCase;

class ConfigurableTypeTest extends TestCase
{
    public function testAddField()
    {
        $type = new ConfigurableType();

        $type->addField($this->field());

        $this->assertCount(1, $type->getFields());
    }

    public function testAddFieldWhenItAlreadyHasOne()
    {
        $type = new ConfigurableType();
        $type->addField($this->field('first'));

        $type->addField($this->field('second'));

        $this->assertCount(2, $type->getFields());
    }

    public function testRemoveField()
    {
        $type = new ConfigurableType();
        $field = $this->field();
        $type->addField($field);

        $type->removeField($field);

        $this->assertCount(0, $type->getFields());
    }

    public function testCreate()
    {
        $type = new ConfigurableType();
        $type->addField(Field::string('foo'));

        $block = $type->create(['foo' => 'bar']);

        $this->assertSame('bar', $block->getString('foo'));
    }

    public function testCreateSetsTheCorrectType()
    {
        $type = new ConfigurableType();

        $block = $type->create([]);

        $this->assertSame('configurable', $block->getType());
    }

    private function field(string $name = null): Field
    {
        return Field::string($name ?? 'my-field');
    }
}
