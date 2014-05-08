<?php

namespace Midnight\Block;

class Html extends AbstractBlock implements BlockInterface
{
    /**
     * @var string
     */
    private $html;

    /**
     * @return string
     */
    public function getHtml()
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