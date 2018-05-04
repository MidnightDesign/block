<?php declare(strict_types=1);

namespace Midnight\Block\View;

use Midnight\Block\Block;
use Midnight\Block\View\Exception\UnknownBlockTypeException;

final class TypeMapBlockRenderer implements BlockRendererInterface
{
    /** @var BlockRendererInterface[] */
    private $renderers;

    public function __construct(array $renderers)
    {
        $this->renderers = $renderers;
    }

    public function render(Block $block): string
    {
        return $this->getRendererFor($block->getType())->render($block);
    }

    /**
     * @throws UnknownBlockTypeException
     */
    private function getRendererFor(string $type): BlockRendererInterface
    {
        if (!isset($this->renderers[$type])) {
            throw UnknownBlockTypeException::fromType($type);
        }
        return $this->renderers[$type];
    }
}
