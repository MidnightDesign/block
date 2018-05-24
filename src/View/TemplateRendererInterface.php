<?php declare(strict_types=1);

namespace Midnight\Block\View;

interface TemplateRendererInterface
{
    public function render(string $template, array $parameters): string;
}
