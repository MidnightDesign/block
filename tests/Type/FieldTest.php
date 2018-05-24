<?php declare(strict_types=1);

namespace Midnight\Test\Block\Type;

use Midnight\Block\Block;
use Midnight\Block\Type\Exception\MissingFieldValueException;
use Midnight\Block\Type\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    public function testSetArrayBlockValue()
    {
        $field = Field::array('my-field');

        $array = ['foo' => 'bar'];
        $block = $field->setBlockValue(new Block(), ['my-field' => $array]);

        $this->assertSame($array, $block->getArray('my-field'));
    }

    public function testSetBlockValueWithMissingField()
    {
        $field = Field::string('my-field')->required();
        $block = new Block();

        $this->expectException(MissingFieldValueException::class);

        $field->setBlockValue($block, []);
    }

    public function testSetBlockDoesNothingIfOptionalFieldIsNotGiven()
    {
        $field = Field::string('my-field');

        $block = $field->setBlockValue(new Block(), []);

        $this->assertNull($block->getString('my-field'));
    }
}
