<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterClassAdvancementRepository")
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     shortName="advancement",
 *     attributes={
 *      "order"={"level":"ASC"},
 *     }
 * )
 */
class CharacterClassAdvancement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("read")
     */
    private $baseAttackBonus;

    /**
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $fortitudeSave;

    /**
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $reflexSave;

    /**
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $willSave;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharacterClass", inversedBy="advancement")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characterClass;

    /**
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $level;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CharacterClassFeature")
     * @Groups("read")
     */
    private $feature;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     * @Groups("read")
     */
    private $spellsPerDay = [];

    /**
     * @ORM\Column(type="json_array", nullable=true)
     * @Groups("read")
     */
    private $spellsKnown = [];

    public function __construct()
    {
        $this->feature = new ArrayCollection();
    }

    /**
     * @Groups("read")
     * @return string
     */
    public function getType(): string
    {
        return 'characterclassadvancement';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBaseAttackBonus(): ?string
    {
        return $this->baseAttackBonus;
    }

    public function setBaseAttackBonus(string $baseAttackBonus): self
    {
        $this->baseAttackBonus = $baseAttackBonus;

        return $this;
    }

    public function getFortitudeSave(): ?int
    {
        return $this->fortitudeSave;
    }

    public function setFortitudeSave(int $fortitudeSave): self
    {
        $this->fortitudeSave = $fortitudeSave;

        return $this;
    }

    public function getReflexSave(): ?int
    {
        return $this->reflexSave;
    }

    public function setReflexSave(int $reflexSave): self
    {
        $this->reflexSave = $reflexSave;

        return $this;
    }

    public function getWillSave(): ?int
    {
        return $this->willSave;
    }

    public function setWillSave(int $willSave): self
    {
        $this->willSave = $willSave;

        return $this;
    }

    public function getCharacterClass(): ?CharacterClass
    {
        return $this->characterClass;
    }

    public function setCharacterClass(?CharacterClass $characterClass): self
    {
        $this->characterClass = $characterClass;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection|CharacterClassFeature[]
     */
    public function getFeature(): Collection
    {
        return $this->feature;
    }

    public function addFeature(CharacterClassFeature $feature): self
    {
        if (!$this->feature->contains($feature)) {
            $this->feature[] = $feature;
        }

        return $this;
    }

    public function removeFeature(CharacterClassFeature $feature): self
    {
        if ($this->feature->contains($feature)) {
            $this->feature->removeElement($feature);
        }

        return $this;
    }

    public function getSpellsPerDay(): ?array
    {
        return $this->spellsPerDay;
    }

    public function setSpellsPerDay(?array $spellsPerDay): self
    {
        $this->spellsPerDay = $spellsPerDay;

        return $this;
    }

    public function getSpellsKnown(): ?array
    {
        return $this->spellsKnown;
    }

    public function setSpellsKnown(?array $spellsKnown): self
    {
        $this->spellsKnown = $spellsKnown;

        return $this;
    }
}
