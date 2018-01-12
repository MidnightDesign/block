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
    public function add(BlockInterface $block, ?int $position = null): void;

    /**
     * @param BlockInterface $block
     * @param int            $position
     *
     * @return void
     */
    public function setPosition(BlockInterface $block, int $position): void;

    /**
     * @return BlockInterface[]
     */
    public function getAll(): array;

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function remove(BlockInterface $block): void;
}
