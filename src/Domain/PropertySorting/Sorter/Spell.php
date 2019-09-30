<?php

namespace App\Domain\PropertySorting\Sorter;

class Spell extends Base
{
    protected function getSortedKeys(): array
    {
        return [
            'name',
            'school',
            'subschool',
            'components',
            'target',
            'castingTime',
            'range',
            'duration',
            'area',
            'savingThrow',
            'spellResistance',
            'description',
            'levels',
            'domains',
            'source',
        ];
    }

    public function getType(): string
    {
        return 'spell';
    }
}