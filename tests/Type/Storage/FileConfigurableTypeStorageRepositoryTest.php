<?php declare(strict_types=1);

namespace Midnight\Test\Block\Type\Storage;

use Midnight\Block\Block;
use Midnight\Block\Type\ConfigurableType;
use Midnight\Block\Type\Field;
use Midnight\Block\Type\Storage\Exception\UnknownConfigurableTypeException;
use Midnight\Block\Type\Storage\FileConfigurableTypeStorageRepository;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class FileConfigurableTypeStorageRepositoryTest extends TestCase
{
    /** @var FileConfigurableTypeStorageRepository */
    private $repository;

    protected function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('foo');
        $this->repository = new FileConfigurableTypeStorageRepository($root->url() . '/');
    }

    public function testDataIsCorrectlyPersistedAndInflated()
    {
        $type = new ConfigurableType();
        $type->addField(Field::string('foo')->required());
        $type->addField(Field::array('bar'));

        $this->repository->save($type);
        $loaded = $this->repository->findById($type->getId());

        $this->assertSame($type->getId(), $loaded->getId());
        $loadedFields = $loaded->getFields();
        $this->assertCount(2, $loadedFields);
        $stringField = $loadedFields[0];
        $this->assertSame('baz', $stringField->setBlockValue(new Block(), ['foo' => 'baz'])->getString('foo'));
    }

    public function testFindByUnknownId()
    {
        $this->expectException(UnknownConfigurableTypeException::class);

        $this->repository->findById('does-not-exist.json');
    }
}
