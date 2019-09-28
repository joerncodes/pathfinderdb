<?php

namespace App\Domain\PropertySorting;

final class Source extends Base
{
    public function getType(): string
    {
        return 'source';
    }

    protected function getSortedKeys(): array
    {
        return [
            'name',
            'link',
            'copyright',
            'type',
        ];
    }
}