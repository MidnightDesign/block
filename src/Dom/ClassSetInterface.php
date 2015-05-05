<?php

namespace Midnight\Block\Dom;

interface ClassSetInterface
{
    /**
     * Returns all classes
     *
     * @return string[]
     */
    public function getAll();

    /**
     * Adds the specified class to the set
     *
     * The input is trimmed before it gets added. If the class already exists, it is ignored.
     *
     * @param string $class
     * @return void
     */
    public function add($class);

    /**
     * Removes the specified class from the set
     *
     * If the specified class is not present, it is ignored.
     *
     * @param string $class
     * @return void
     */
    public function remove($class);
}