<?php
declare(strict_types=1);

namespace Midnight\Block\Dom;

class ClassSet implements ClassSetInterface
{
    /** @var string[] */
    private $classes = [];

    public function getAll(): array
    {
        return $this->classes;
    }

    public function add(string $class): void
    {
        $class = trim($class);
        if ($class === '') {
            return;
        }
        if (!\in_array($class, $this->classes, true)) {
            $this->classes[] = $class;
        }
    }

    public function remove(string $class): void
    {
        $key = array_search($class, $this->classes, true);
        if ($key !== false) {
            unset($this->classes[$key]);
        }
    }

    public static function toString(ClassSetInterface $classSet): string
    {
        $classes = $classSet->getAll();
        if (0 === \count($classes)) {
            return '';
        }
        return sprintf(' class="%s"', implode(' ', $classes));
    }
}
