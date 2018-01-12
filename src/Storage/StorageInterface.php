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
    public function save(BlockInterface $block);

    /**
     * @param string $id
     *
     * @return BlockInterface
     */
    public function load($id);

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function delete(BlockInterface $block);
}
