<?php

namespace App\Domain\PropertySorting\Sorter;

final class CharacterClass extends Base
{
    public function getType(): string
    {
        return 'characterclass';
    }

    protected function getSortedKeys(): array
    {
        return [
            'name',
            'type',
            'hitDie',
            'alignment',
            'startingWealth',
            'skillRanksPerLevel',
            'classSkills',
            'advancement',
            'description',
            'role',
            'source',
            'type'
        ];
    }
}