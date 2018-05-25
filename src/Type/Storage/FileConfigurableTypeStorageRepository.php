<?php declare(strict_types=1);

namespace Midnight\Block\Type\Storage;

use Midnight\Block\Type\ConfigurableType;
use Midnight\Block\Type\Storage\Exception\UnknownConfigurableTypeException;

final class FileConfigurableTypeStorageRepository implements ConfigurableTypeStorageInterface, ConfigurableTypeRepositoryInterface
{
    /** @var string */
    private $filePrefix;

    public function __construct(string $filePrefix = './')
    {
        $this->filePrefix = $filePrefix;
    }

    public function save(ConfigurableType $type): void
    {
        \file_put_contents($this->buildPath($type->getId()), \json_encode($type->serialize()));
    }

    /**
     * @throws UnknownConfigurableTypeException
     */
    public function findById(string $id): ConfigurableType
    {
        $path = $this->buildPath($id);
        if (!\file_exists($path)) {
            throw UnknownConfigurableTypeException::fromId($id);
        }
        return $this->loadFromFile($path);
    }

    /**
     * @return ConfigurableType[]
     */
    public function findAll(): array
    {
        $types = [];
        $directoryIterator = new \DirectoryIterator($this->filePrefix);
        foreach ($directoryIterator as $file) {
            if (!$file->isFile()) {
                continue;
            }
            $types[] = $this->loadFromFile($file->getPathname());
        }
        return $types;
    }

    private function buildPath(string $id): string
    {
        return $this->filePrefix . $id . '.json';
    }

    private function loadFromFile(string $path): ConfigurableType
    {
        $json = \file_get_contents($path);
        $data = \json_decode($json, true);
        return ConfigurableType::deserialize($data);
    }
}
