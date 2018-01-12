<?php
declare(strict_types=1);

namespace Midnight\Block;

class Html extends AbstractBlock
{
    /** @var string */
    private $html;

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }
}
