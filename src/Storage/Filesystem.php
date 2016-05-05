<?php

namespace Midnight\Block\Storage;

use Midnight\Block\BlockInterface;
use Midnight\Block\Exception\BlockNotFoundException;
use RuntimeException;

class Filesystem implements StorageInterface
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function save(BlockInterface $block)
    {
        if (!is_dir($this->directory)) {
            $mkdirResult = mkdir($this->directory, 0777, true);
            if ($mkdirResult === false) {
                throw new RuntimeException(sprintf('Could not create directory "%s".', $this->directory));
            }
        }
        if (!is_writeable($this->directory)) {
            throw new RuntimeException(sprintf('Cannot save to "%s" because it is not writeable.', $this->directory));
        }
        file_put_contents($this->buildPath($block->getId()), serialize($block));
    }

    /**
     * @param string $id
     *
     * @return string
     */
    private function buildPath($id)
    {
        return $this->directory . DIRECTORY_SEPARATOR . $id;
    }

    /**
     * @param string $id
     * @return BlockInterface
     * @throws BlockNotFoundException
     */
    public function load($id)
    {
        $path = $this->buildPath($id);
        if (!is_file($path)) {
            throw BlockNotFoundException::fromId($id);
        }
        return unserialize(file_get_contents($path));
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function delete(BlockInterface $block)
    {
        unlink($this->buildPath($block->getId()));
    }
}
