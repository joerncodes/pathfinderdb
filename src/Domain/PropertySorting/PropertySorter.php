<?php

namespace App\Domain\PropertySorting;

final class PropertySorter
{
    /**
     * @var iterable
     */
    private $sorters;

    public function __construct(iterable $sorters)
    {
        $this->sorters = $sorters;
    }

    public function sort(object $object)
    {
        foreach ($this->sorters as $sorter) {
            if (!$sorter instanceof SorterInterface) {
                throw new \InvalidArgumentException('Only instances of SorterInterface allowed.');
            }
            if (isset($object->type) && $sorter->getType() === $object->type) {
                return $sorter->sort($object);
            }
        }

        return $object;
    }
}
