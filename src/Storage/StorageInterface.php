<?php

namespace Midnight\Block\Storage;

use Midnight\Block\BlockInterface;
use RuntimeException;

interface StorageInterface
{
    /**
     * @param BlockInterface $block
     * @return void
     */
    public function save(BlockInterface $block);

    /**
     * @param string $id
     * @return BlockInterface
     * @throws RuntimeException
     */
    public function load($id);

    /**
     * @param BlockInterface $block
     * @return void
     */
    public function delete(BlockInterface $block);
}
