<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use App\Entity\Traits\HasSourceTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     attributes={"order"={"name"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"name": "partial"})
 * @ORM\Entity(repositoryClass="App\Repository\SpellRepository")
 */
class Spell extends ApiBase
{
    use HasSourceTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MagicSchool", inversedBy="spells")
     * @Groups("read")
     * @ORM\JoinColumn(nullable=false)
     */
    private $school;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("read")
     */
    private $subschool;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $spellRange;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("read")
     */
    private $target;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("read")
     */
    private $castingTime;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("read")
     */
    private $area;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SpellClassLevel", mappedBy="spell")
     */
    private $spellClassLevels;

    /**
     * @ORM\Column(type="json_array")
     * @Groups("read")
     */
    private $components = [];

    /**
     * @ORM\Column(type="text")
     * @Groups("read")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("read")
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("read")
     */
    private $savingThrow;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("read")
     */
    private $spellResistance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SpellDomainLevel", mappedBy="spell")
     * @var SpellDomainLevel[]
     */
    private $spellDomainLevels;

    public function __construct()
    {
        $this->spellClassLevels = new ArrayCollection();
        $this->spellDomainLevels = new ArrayCollection();
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @Groups("read")
     */
    public function getDomains(): array
    {
        $domains= [];
        foreach($this->spellDomainLevels as $spellDomainLevel)
        {
            $domains[] = $spellDomainLevel->getDomain()->getName() . ' '
                . $spellDomainLevel->getLevel();
        }
        return $domains;
    }

    /**
     * "Range" is reserved in MySQL.
     *
     * @return string|null
     * @Groups("read")
     */
    public function getRange(): ?string
    {
        return $this->spellRange;
    }

    /**
     * @return MagicSchool|null
     */
    public function getSchool(): ?MagicSchool
    {
        return $this->school;
    }

    public function setSchool(?MagicSchool $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getSubschool(): ?string
    {
        return $this->subschool;
    }

    public function setSubschool(?string $subschool): self
    {
        $this->subschool = $subschool;

        return $this;
    }

    public function getSpellRange(): ?string
    {
        return $this->spellRange;
    }

    public function setSpellRange(string $spellRange): self
    {
        $this->spellRange = $spellRange;

        return $this;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function setTarget(string $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function getCastingTime(): ?string
    {
        return $this->castingTime;
    }

    public function setCastingTime(string $castingTime): self
    {
        $this->castingTime = $castingTime;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return Collection|SpellClassLevel[]
     */
    public function getSpellClassLevels(): Collection
    {
        return $this->spellClassLevels;
    }

    /**
     * @Groups("read")
     *
     * @return array
     */
    public function getLevels(): array
    {
        $result = [];
        foreach ($this->spellClassLevels as $spellClassLevel) {
            $result[] =
                $spellClassLevel->getCharacterClass()->getName().' '.$spellClassLevel->getLevel();
        }

        return $result;
    }

    public function addSpellClassLevel(SpellClassLevel $spellClassLevel): self
    {
        if (!$this->spellClassLevels->contains($spellClassLevel)) {
            $this->spellClassLevels[] = $spellClassLevel;
            $spellClassLevel->setSpell($this);
        }

        return $this;
    }

    public function removeSpellClassLevel(SpellClassLevel $spellClassLevel): self
    {
        if ($this->spellClassLevels->contains($spellClassLevel)) {
            $this->spellClassLevels->removeElement($spellClassLevel);
            // set the owning side to null (unless already changed)
            if ($spellClassLevel->getSpell() === $this) {
                $spellClassLevel->setSpell(null);
            }
        }

        return $this;
    }

    public function getComponents(): ?array
    {
        return $this->components;
    }

    public function setComponents(array $components): self
    {
        $this->components = $components;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getSavingThrow(): ?string
    {
        return $this->savingThrow;
    }

    public function setSavingThrow(?string $savingThrow): self
    {
        $this->savingThrow = $savingThrow;

        return $this;
    }

    public function getSpellResistance(): ?string
    {
        return $this->spellResistance;
    }

    public function setSpellResistance(?string $spellResistance): self
    {
        $this->spellResistance = $spellResistance;

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
            $spellDomainLevel->setSpell($this);
        }

        return $this;
    }

    public function removeSpellDomainLevel(SpellDomainLevel $spellDomainLevel): self
    {
        if ($this->spellDomainLevels->contains($spellDomainLevel)) {
            $this->spellDomainLevels->removeElement($spellDomainLevel);
            // set the owning side to null (unless already changed)
            if ($spellDomainLevel->getSpell() === $this) {
                $spellDomainLevel->setSpell(null);
            }
        }

        return $this;
    }
}
