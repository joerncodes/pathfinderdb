<?php

namespace App\Domain\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Domain\Markdown\Content;
use App\Domain\Markdown\Exception;
use App\Domain\ValueObject\Markdown;
use App\Entity\Spell;
use App\Repository\SpellRepository;

final class SpellItemProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var SpellRepository
     */
    private $repository;
    /**
     * @var Content
     */
    private $markdown;

    public function __construct(SpellRepository $repository, Content $markdown)
    {
        $this->repository = $repository;
        $this->markdown = $markdown;
    }

    /**
     * Retrieves an item.
     *
     * @param array|int|string $id
     *
     * @throws ResourceClassNotSupportedException
     *
     * @return object|null
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): Spell
    {
        $spell = $this->repository->findOneBySlug($id);

        try {
            $description = $this->getDescription($spell);
            $spell->setDescriptionObject($description);
        } catch (Exception $e) {
        }

        return $spell;
    }

    private function getDescription(Spell $spell): ?Markdown
    {
        $filename = $spell->getSlug().'.md';

        return $this->markdown->fromFilename($filename);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Spell::class === $resourceClass;
    }
}
