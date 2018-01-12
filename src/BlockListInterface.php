<?php
declare(strict_types=1);

namespace Midnight\Block;

interface BlockListInterface
{
    public function add(BlockInterface $block, ?int $position = null): void;

    public function setPosition(BlockInterface $block, int $position): void;

    /**
     * @return BlockInterface[]
     */
    public function getAll(): array;

    public function remove(BlockInterface $block): void;
}
