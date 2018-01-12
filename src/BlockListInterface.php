<?php
declare(strict_types=1);

namespace Midnight\Block;

interface BlockListInterface
{
    /**
     * @param BlockInterface $block
     * @param int|null       $position
     *
     * @return void
     */
    public function add(BlockInterface $block, $position = null);

    /**
     * @param BlockInterface $block
     * @param int            $position
     *
     * @return void
     */
    public function setPosition(BlockInterface $block, $position);

    /**
     * @return BlockInterface[]
     */
    public function getAll();

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function remove(BlockInterface $block);
}
