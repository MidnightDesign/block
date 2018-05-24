<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use Midnight\Block\Block;

abstract class AbstractType
{
    abstract public function render(Block $block): string;
}
