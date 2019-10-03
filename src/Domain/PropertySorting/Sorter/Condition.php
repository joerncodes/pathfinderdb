<?php

namespace App\Domain\PropertySorting\Sorter;

class Condition extends Base
{
    protected function getSortedKeys(): array
    {
        return [
            'name',
            'slug',
            'description',
        ];
    }

    public function getType(): string
    {
        return 'condition';
    }
}