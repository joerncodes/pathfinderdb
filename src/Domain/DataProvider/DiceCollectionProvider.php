<?php

namespace App\Domain\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Dice;

final class DiceCollectionProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * Retrieves a collection.
     *
     * @throws ResourceClassNotSupportedException
     *
     * @return iterable
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        yield new Dice('d4');
        yield new Dice('d6');
        yield new Dice('d8');
        yield new Dice('d12');
        yield new Dice('d20');
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Dice::class;
    }
}