<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterClassFeatureRepository")
 * @ApiResource(
 *     shortName="feature",
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 * )
 */
class CharacterClassFeature extends ApiBase
{
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Groups("read")
     */
    private $featureType;

    /**
     * @ORM\Column(type="text")
     * @Groups("read")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Domain", inversedBy="features")
     */
    private $domain;

    public function getFeatureType(): ?string
    {
        return $this->featureType;
    }

    public function setFeatureType(?string $featureType): self
    {
        $this->featureType = $featureType;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    public function setDomain(?Domain $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getApplicablePropertyNames(): array
    {
        return ['description'];
    }
}
