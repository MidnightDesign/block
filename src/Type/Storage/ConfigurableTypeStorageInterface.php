<?php declare(strict_types=1);

namespace Midnight\Block\Type\Storage;

use Midnight\Block\Type\ConfigurableType;

interface ConfigurableTypeStorageInterface
{
    public function save(ConfigurableType $type): void;
}
