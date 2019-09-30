<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\HasSourceTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DomainRepository")
 */
class Domain extends ApiBase
{
    use HasSourceTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CharacterClassFeature", mappedBy="domain")
     */
    private $feature;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Domain", inversedBy="subdomains")
     */
    private $parentDomain;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Domain", mappedBy="parentDomain")
     */
    private $subdomains;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SpellDomainLevel", mappedBy="domain")
     */
    private $spellDomainLevels;

    public function __construct()
    {
        $this->feature = new ArrayCollection();
        $this->subdomains = new ArrayCollection();
        $this->spellDomainLevels = new ArrayCollection();
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
            $feature->setDomain($this);
        }

        return $this;
    }

    public function removeFeature(CharacterClassFeature $feature): self
    {
        if ($this->feature->contains($feature)) {
            $this->feature->removeElement($feature);
            // set the owning side to null (unless already changed)
            if ($feature->getDomain() === $this) {
                $feature->setDomain(null);
            }
        }

        return $this;
    }

    public function getParentDomain(): ?self
    {
        return $this->parentDomain;
    }

    public function setParentDomain(?self $parentDomain): self
    {
        $this->parentDomain = $parentDomain;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSubdomains(): Collection
    {
        return $this->subdomains;
    }

    public function addSubdomain(self $subdomain): self
    {
        if (!$this->subdomains->contains($subdomain)) {
            $this->subdomains[] = $subdomain;
            $subdomain->setParentDomain($this);
        }

        return $this;
    }

    public function removeSubdomain(self $subdomain): self
    {
        if ($this->subdomains->contains($subdomain)) {
            $this->subdomains->removeElement($subdomain);
            // set the owning side to null (unless already changed)
            if ($subdomain->getParentDomain() === $this) {
                $subdomain->setParentDomain(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SpellDomainLevel[]
     */
    public function getSpellDomainLevels(): Collection
    {
        return $this->spellDomainLevels;
    }

    public function addSpellDomainLevel(SpellDomainLevel $spellDomainLevel): self
    {
        if (!$this->spellDomainLevels->contains($spellDomainLevel)) {
            $this->spellDomainLevels[] = $spellDomainLevel;
            $spellDomainLevel->setDomain($this);
        }

        return $this;
    }

    public function removeSpellDomainLevel(SpellDomainLevel $spellDomainLevel): self
    {
        if ($this->spellDomainLevels->contains($spellDomainLevel)) {
            $this->spellDomainLevels->removeElement($spellDomainLevel);
            // set the owning side to null (unless already changed)
            if ($spellDomainLevel->getDomain() === $this) {
                $spellDomainLevel->setDomain(null);
            }
        }

        return $this;
    }
}
