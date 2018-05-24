<?php declare(strict_types=1);

namespace Midnight\Block\View;

final class SimpleTemplateRenderer implements TemplateRendererInterface
{
    /** @var string */
    private $keyPattern;

    public function __construct(string $keyPattern = null)
    {
        $this->keyPattern = $keyPattern ?? '{{%s}}';
    }

    public function render(string $template, array $parameters): string
    {
        $searchKeys = \array_map(function (string $key): string {
            return \sprintf($this->keyPattern, $key);
        }, \array_keys($parameters));
        $replacements = \array_values($parameters);
        return \str_replace($searchKeys, $replacements, $template);
    }
}
