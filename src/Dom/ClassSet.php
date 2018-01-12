<?php
declare(strict_types=1);

namespace Midnight\Block\Dom;

class ClassSet implements ClassSetInterface
{
    /** @var string[] */
    private $classes = [];

    /**
     * {@inheritdoc}
     */
    public function getAll(): array
    {
        return $this->classes;
    }

    /**
     * {@inheritdoc}
     */
    public function add($class): void
    {
        $class = trim($class);
        if ($class === '') {
            return;
        }
        if (!in_array($class, $this->classes)) {
            $this->classes[] = $class;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function remove($class): void
    {
        $key = array_search($class, $this->classes);
        if ($key !== false) {
            unset($this->classes[$key]);
        }
    }

    /**
     * @param ClassSetInterface $classSet
     * @return string
     */
    public static function toString(ClassSetInterface $classSet): string
    {
        $classes = $classSet->getAll();
        if (0 === count($classes)) {
            return '';
        }
        return sprintf(' class="%s"', implode(' ', $classes));
    }
}
