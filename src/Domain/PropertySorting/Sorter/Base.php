<?php

namespace App\Domain\PropertySorting\Sorter;

use App\Domain\PropertySorting\PropertySorter;
use App\Domain\PropertySorting\SorterInterface;

abstract class Base implements SorterInterface
{
    /**
     * @var PropertySorter
     */
    protected $propertySorter;

    public function __construct(PropertySorter $propertySorter)
    {
        $this->propertySorter = $propertySorter;
    }

    abstract protected function getSortedKeys(): array;

    private function childSort($key, $value)
    {
        if(is_array($value)) {
            $sorted = [];
            foreach($value as $child)
            {
                if(!is_object($child)) {
                    $sorted[] = $child;
                    continue;
                }

                $sorted[] = $this->propertySorter->sort($child);
            }
            return $sorted;
        }
        elseif(is_object($value)) {
            return $this->propertySorter->sort($value);
        }
    }

    public function sort(object $object): object
    {
        $sorted = new \stdClass();
        foreach ($this->getSortedKeys() as $key) {
            $sorted->$key = $this->childSort($key, $object->$key) ?? $object->$key;
        }

        foreach ($object as $key => $value) {
            if (!isset($sorted->$key)) {
                $sorted->$key = $value;
            }
        }

        unset($sorted->type);

        return $sorted;
    }
}
