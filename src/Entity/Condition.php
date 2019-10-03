<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ConditionRepository")
 * @ORM\Table(name="ruleCondition")
 */
class Condition extends ApiBase
{
    /**
     * @ORM\Column(type="text")
     * @Groups("read")
     */
    private $description;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
