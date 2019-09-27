<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
}
