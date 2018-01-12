<?php
declare(strict_types=1);

namespace Midnight\Block\Renderer;

use Midnight\Block\BlockInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

class PsrContainerRenderer implements RendererInterface
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @throws ContainerExceptionInterface
     */
    public function render(BlockInterface $block): string
    {
        return $this->container->get($block->getTypeName())->render($block);
    }
}
