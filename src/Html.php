<?php
declare(strict_types=1);

namespace Midnight\Block;

class Html extends AbstractBlock
{
    /** @var string */
    private $html;

    public function getHtml(): string
    {
        return $this->html;
    }

    public function setHtml(string $html): void
    {
        $this->html = $html;
    }
}
