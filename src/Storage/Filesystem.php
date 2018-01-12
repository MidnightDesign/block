<?php
declare(strict_types=1);

namespace Midnight\Block\Storage;

use Midnight\Block\BlockInterface;
use RuntimeException;

class Filesystem implements StorageInterface
{
    /** @var string */
    private $directory;

    /**
     * @param string $directory
     * @throws \RuntimeException
     */
    public function __construct($directory)
    {
        $this->setDirectory($directory);
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function save(BlockInterface $block): void
    {
        $id = $block->getId();
        if (!$id) {
            $block->setId(uniqid('', true));
            $id = $block->getId();
        }
        file_put_contents($this->buildPath($id), serialize($block));
    }

    /**
     * @param string $id
     *
     * @return string
     */
    private function buildPath($id): string
    {
        return $this->getDirectory() . DIRECTORY_SEPARATOR . $id;
    }

    /**
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     * @throws \RuntimeException
     */
    public function setDirectory($directory)
    {
        if (!file_exists($directory)) {
            set_error_handler(function () { /* ignore errors */
            });
            if (!mkdir($directory) && !is_dir($directory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
            }
            restore_error_handler();
        }
        $this->checkDirectory($directory);
        $this->directory = realpath($directory);
    }

    /**
     * @param string $id
     *
     * @return BlockInterface|null
     */
    public function load(string $id): ?BlockInterface
    {
        $path = $this->buildPath($id);
        if (!is_file($path)) {
            return null;
        }
        return unserialize(file_get_contents($path));
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function delete(BlockInterface $block): void
    {
        unlink($this->buildPath($block->getId()));
    }

    /**
     * @param string $directory
     * @throws \RuntimeException
     * @throws RuntimeException
     */
    private function checkDirectory($directory)
    {
        if (!file_exists($directory)) {
            throw new RuntimeException(sprintf('Couldn\'t create "%s".', $directory));
        }
        if (!is_readable($directory)) {
            throw new RuntimeException(sprintf('"%s" is not readable.', $directory));
        }
        if (!is_writable($directory)) {
            throw new RuntimeException(sprintf('"%s" is not writable.', $directory));
        }
    }
}
