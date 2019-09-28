<?php

namespace App\Domain\PropertySorting;

final class Spell extends Base
{
    public function getType(): string
    {
        return 'spell';
    }

    protected function getSortedKeys(): array
    {
        return [
            'name',
            'school',
            'subschool',
            'target',
            'castingTime',
            'components',
            'range',
            'description',
            'levels',
            'source',
            'type'
        ];
    }
}
