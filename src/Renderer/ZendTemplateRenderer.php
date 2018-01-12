<?php declare(strict_types=1);

namespace Midnight\Block\Renderer;

use Midnight\Block\BlockInterface;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\RendererInterface as ZendRendererInterface;

class ZendTemplateRenderer implements RendererInterface
{
    /** @var ZendRendererInterface */
    private $renderer;
    /** @var string */
    private $template;

    public function __construct(ZendRendererInterface $renderer, string $template)
    {
        $this->renderer = $renderer;
        $this->template = $template;
    }

    public function render(BlockInterface $block): string
    {
        $viewModel = new ViewModel(['block' => $block]);
        $viewModel->setTemplate($this->template);
        return $this->renderer->render($viewModel);
    }
}
