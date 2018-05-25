<?php declare(strict_types=1);

namespace Midnight\Test\Block\Type\Storage;

use Midnight\Block\Type\ConfigurableType;
use Midnight\Block\Type\Storage\Exception\UnknownConfigurableTypeException;
use Midnight\Block\Type\Storage\MemoryConfigurableTypeStorageRepository;
use PHPUnit\Framework\TestCase;

class MemoryConfigurableTypeStorageRepositoryTest extends TestCase
{
    /** @var MemoryConfigurableTypeStorageRepository */
    private $repository;

    protected function setUp()
    {
        parent::setUp();

        $this->repository = new MemoryConfigurableTypeStorageRepository();
    }

    public function testDataIsCorrectlyPersistedAndInflated()
    {
        $type = new ConfigurableType();

        $this->repository->save($type);
        $loaded = $this->repository->findById($type->getId());

        $this->assertSame($type->getId(), $loaded->getId());
    }

    public function testFindByUnknownId()
    {
        $this->expectException(UnknownConfigurableTypeException::class);

        $this->repository->findById('does-not-exist.json');
    }

    public function testFindAll()
    {
        $this->repository->save(new ConfigurableType());
        $this->repository->save(new ConfigurableType());

        $types = $this->repository->findAll();

        $this->assertCount(2, $types);
    }
}
