<?php

namespace Midnight\Block;

/**
 * Interface BlockContainerInterface
 *
 * @package Midnight\Block
 */
interface BlockContainerInterface
{
    /**
     * Adds a block to the container
     *
     * Adds the new block at the specified position. This does not replace the block at that position, but shifts it and
     * all of the following ones by one. If the $position is NULL or does not exist, the block is appended at the end.
     *
     * @param BlockInterface $block
     * @param int|null       $position
     * @return void
     */
    public function addBlock(BlockInterface $block, $position = null);

    /**
     * @return BlockInterface[]
     */
    public function getBlocks();

    /**
     * @param BlockInterface $block
     * @return void
     */
    public function removeBlock(BlockInterface $block);

    /**
     * @param BlockInterface $block
     * @param int            $position
     * @return void
     */
    public function moveBlock(BlockInterface $block, $position);
}
