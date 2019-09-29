<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Entity\Traits\HasSourceTrait;
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
class CharacterClass extends ApiBase
{
    use HasSourceTrait;

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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SpellClassLevel", mappedBy="characterClass")
     */
    private $spellClassLevels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterClassAdvancement", mappedBy="characterClass", orphanRemoval=true)
     * @Groups("read")
     */
    private $advancement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read")
     */
    private $startingWealth;

    public function __construct()
    {
        $this->classSkills = new ArrayCollection();
        $this->spellClassLevels = new ArrayCollection();
        $this->advancement = new ArrayCollection();
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

    public function getClassSkills(): array
    {
        $classSkills = [];
        foreach ($this->getClassSkillsCollection() as $skill) {
            $classSkills[] = sprintf('%s (%s)',
                $skill->getName(), $skill->getAbility()->getAcronym());
        }

        return $classSkills;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getClassSkillsCollection(): Collection
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

    /**
     * @return Collection|SpellClassLevel[]
     */
    public function getSpellClassLevels(): Collection
    {
        return $this->spellClassLevels;
    }

    public function addSpellClassLevel(SpellClassLevel $spellClassLevel): self
    {
        if (!$this->spellClassLevels->contains($spellClassLevel)) {
            $this->spellClassLevels[] = $spellClassLevel;
            $spellClassLevel->setCharacterClass($this);
        }

        return $this;
    }

    public function removeSpellClassLevel(SpellClassLevel $spellClassLevel): self
    {
        if ($this->spellClassLevels->contains($spellClassLevel)) {
            $this->spellClassLevels->removeElement($spellClassLevel);
            // set the owning side to null (unless already changed)
            if ($spellClassLevel->getCharacterClass() === $this) {
                $spellClassLevel->setCharacterClass(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CharacterClassAdvancement[]
     */
    public function getAdvancement(): Collection
    {
        return $this->advancement;
    }

    public function addAdvancement(CharacterClassAdvancement $advancement): self
    {
        if (!$this->advancement->contains($advancement)) {
            $this->advancement[] = $advancement;
            $advancement->setCharacterClass($this);
        }

        return $this;
    }

    public function removeAdvancement(CharacterClassAdvancement $advancement): self
    {
        if ($this->advancement->contains($advancement)) {
            $this->advancement->removeElement($advancement);
            // set the owning side to null (unless already changed)
            if ($advancement->getCharacterClass() === $this) {
                $advancement->setCharacterClass(null);
            }
        }

        return $this;
    }

    public function getStartingWealth(): ?string
    {
        return $this->startingWealth;
    }

    public function setStartingWealth(string $startingWealth): self
    {
        $this->startingWealth = $startingWealth;

        return $this;
    }
}
