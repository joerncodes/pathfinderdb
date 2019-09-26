<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     shortName="class"
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CharacterClassRepository")
 */
class CharacterClass
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
     * @ORM\Column(type="string", length=10)
     * @Groups("read")
     */
    private $hitDie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read")
     */
    private $alignment;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Skill")
     * @Groups("read")
     */
    private $classSkills;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $skillRanksPerLevel;

    public function __construct()
    {
        $this->classSkills = new ArrayCollection();
    }

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

    public function getHitDie(): ?string
    {
        return $this->hitDie;
    }

    public function setHitDie(string $hitDie): self
    {
        $this->hitDie = $hitDie;

        return $this;
    }

    public function getAlignment(): ?string
    {
        return $this->alignment;
    }

    public function setAlignment(string $alignment): self
    {
        $this->alignment = $alignment;

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getClassSkills(): Collection
    {
        return $this->classSkills;
    }

    public function addClassSkill(Skill $classSkill): self
    {
        if (!$this->classSkills->contains($classSkill)) {
            $this->classSkills[] = $classSkill;
        }

        return $this;
    }

    public function removeClassSkill(Skill $classSkill): self
    {
        if ($this->classSkills->contains($classSkill)) {
            $this->classSkills->removeElement($classSkill);
        }

        return $this;
    }

    public function getSkillRanksPerLevel(): ?string
    {
        return $this->skillRanksPerLevel;
    }

    public function setSkillRanksPerLevel(string $skillRanksPerLevel): self
    {
        $this->skillRanksPerLevel = $skillRanksPerLevel;

        return $this;
    }
}
