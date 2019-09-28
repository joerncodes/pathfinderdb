<?php

namespace App\Domain\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Dice;

class DiceItemProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * Retrieves an item.
     *
     * @param array|int|string $id
     *
     * @throws ResourceClassNotSupportedException
     *
     * @return object|null
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): Dice
    {
        return new Dice($id);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Dice::class;
    }
}