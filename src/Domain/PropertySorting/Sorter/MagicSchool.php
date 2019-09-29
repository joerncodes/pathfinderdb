<?php

namespace App\Domain\PropertySorting\Sorter;

class MagicSchool extends Base
{
    protected function getSortedKeys(): array
    {
        return ['name'];
    }

    public function getType(): string
    {
        return 'magicschool';
    }
}