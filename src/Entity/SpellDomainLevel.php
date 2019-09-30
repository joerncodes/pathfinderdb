<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpellDomainLevelRepository")
 */
class SpellDomainLevel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Spell", inversedBy="spellDomainLevels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spell;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Domain", inversedBy="spellDomainLevels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $domain;

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

    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    public function setDomain(?Domain $domain): self
    {
        $this->domain = $domain;

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
