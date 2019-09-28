<?php

namespace App\Domain\PropertySorting\Sorter;

final class CharacterClassFeature extends Base
{
    public function getType(): string
    {
        return 'characterclassfeature';
    }

    protected function getSortedKeys(): array
    {
        return [
            'name',
            'featureType',
            'description',
            'type'
        ];
    }
}
