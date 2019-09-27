<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpellClassLevelRepository")
 */
class SpellClassLevel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spell", inversedBy="spellClassLevels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spell;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CharacterClass", inversedBy="spellClassLevels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characterClass;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpell(): ?Spell
    {
        return $this->spell;
    }

    public function setSpell(?Spell $spell): self
    {
        $this->spell = $spell;

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
