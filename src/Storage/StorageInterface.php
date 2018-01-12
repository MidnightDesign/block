<?php
declare(strict_types=1);

namespace Midnight\Block\Storage;

use Midnight\Block\BlockInterface;

interface StorageInterface
{
    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function save(BlockInterface $block): void;

    /**
     * @param string $id
     *
     * @return BlockInterface|null
     */
    public function load(string $id): ?BlockInterface;

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function delete(BlockInterface $block): void;
}
