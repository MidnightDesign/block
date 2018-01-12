<?php
declare(strict_types=1);

namespace Midnight\Block;

interface BlockContainerInterface
{
    /**
     * Adds a block to the container
     *
     * Adds the new block at the specified position. This does not replace the block at that position, but shifts it and
     * all of the following ones by one. If the $position is NULL or does not exist, the block is appended at the end.
     */
    public function addBlock(BlockInterface $block, ?int $position = null): void;

    /**
     * @return BlockInterface[]
     */
    public function getBlocks(): array;

    public function removeBlock(BlockInterface $block): void;

    public function moveBlock(BlockInterface $block, int $position): void;
}
