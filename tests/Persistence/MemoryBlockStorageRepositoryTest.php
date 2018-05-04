<?php declare(strict_types=1);

namespace Midnight\Test\Block\Persistence;

use Midnight\Block\Persistence\Exception\UnknownBlockException;
use Midnight\Block\Persistence\MemoryBlockStorageRepository;
use PHPUnit\Framework\TestCase;

class MemoryBlockStorageRepositoryTest extends TestCase
{
    /** @var MemoryBlockStorageRepository */
    private $storageRepository;

    protected function setUp()
    {
        parent::setUp();

        $this->storageRepository = new MemoryBlockStorageRepository();
    }

    public function testFindByIdThrowsExceptionIfTheIdIsUnknown()
    {
        $this->expectException(UnknownBlockException::class);

        $this->storageRepository->findById('does-not-exist');
    }
}
