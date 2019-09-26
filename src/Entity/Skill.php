<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 */
class Skill
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ApiProperty(identifier=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("read")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @ApiProperty(identifier=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("read")
     */
    private $untrained;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("read")
     */
    private $armorCheckPenalty;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ability", inversedBy="skills")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("read")
     */
    private $ability;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUntrained(): ?bool
    {
        return $this->untrained;
    }

    public function setUntrained(bool $untrained): self
    {
        $this->untrained = $untrained;

        return $this;
    }

    public function getArmorCheckPenalty(): ?bool
    {
        return $this->armorCheckPenalty;
    }

    public function setArmorCheckPenalty(bool $armorCheckPenalty): self
    {
        $this->armorCheckPenalty = $armorCheckPenalty;

        return $this;
    }

    public function getAbility(): ?Ability
    {
        return $this->ability;
    }

    public function setAbility(?Ability $ability): self
    {
        $this->ability = $ability;

        return $this;
    }
}
