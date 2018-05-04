<?php declare(strict_types=1);

namespace Midnight\Block\Persistence;

use Midnight\Block\Block;
use Midnight\Block\Persistence\Exception\UnknownBlockException;

final class MemoryBlockStorageRepository implements BlockStorageInterface, BlockRepositoryInterface
{
    /** @var Block[] */
    private $blocks = [];

    public function persist(Block ...$blocks): void
    {
        foreach ($blocks as $block) {
            $this->blocks[$block->getId()] = $block;
        }
    }

    /**
     *
     * @throws UnknownBlockException
     */
    public function findById(string $id): Block
    {
        if (!isset($this->blocks[$id])) {
            throw UnknownBlockException::fromId($id);
        }
        return $this->blocks[$id];
    }

    public function findAll(): array
    {
        return \array_values($this->blocks);
    }
}
