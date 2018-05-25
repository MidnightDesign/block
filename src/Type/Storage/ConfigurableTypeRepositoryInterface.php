<?php declare(strict_types=1);

namespace Midnight\Block\Type\Storage;

use Midnight\Block\Type\ConfigurableType;
use Midnight\Block\Type\Storage\Exception\UnknownConfigurableTypeException;

interface ConfigurableTypeRepositoryInterface
{
    /**
     * @throws UnknownConfigurableTypeException
     */
    public function findById(string $id): ConfigurableType;
}
