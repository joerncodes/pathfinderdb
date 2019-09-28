<?php

namespace App\Domain\PropertySorting;

interface SorterInterface
{
    public function getType(): string;
    public function sort(object $object): object;
}