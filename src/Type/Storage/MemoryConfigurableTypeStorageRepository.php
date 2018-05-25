<?php declare(strict_types=1);

namespace Midnight\Block\Type\Storage;

use Midnight\Block\Type\ConfigurableType;

final class MemoryConfigurableTypeStorageRepository implements ConfigurableTypeRepositoryInterface, ConfigurableTypeStorageInterface
{
    /** @var ConfigurableType[] */
    private $types = [];

    public function save(ConfigurableType $type): void
    {
        $this->types[$type->getId()] = $type;
    }

    /**
     * @throws Exception\UnknownConfigurableTypeException
     */
    public function findById(string $id): ConfigurableType
    {
        if (!isset($this->types[$id])) {
            throw Exception\UnknownConfigurableTypeException::fromId($id);
        }
        return $this->types[$id];
    }
}
