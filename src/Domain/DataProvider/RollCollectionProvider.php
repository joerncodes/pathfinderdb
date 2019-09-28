<?php

namespace App\Domain\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Roll;

final class RollCollectionProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
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
        yield new Roll('d4');
        yield new Roll('d6');
        yield new Roll('d8');
        yield new Roll('d12');
        yield new Roll('d20');
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Roll::class;
    }
}