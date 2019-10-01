<?php

namespace App\Domain\PropertySorting\Sorter;

final class CharacterClassAdvancement extends Base
{
    public function getType(): string
    {
        return 'characterclassadvancement';
    }

    protected function getSortedKeys(): array
    {
        return [
            'level',
            'baseAttackBonus',
            'fortitudeSave',
            'reflexSave',
            'willSave',
            'spellsPerDay',
            'spellsKnown',
            'feature',
        ];
    }
}
