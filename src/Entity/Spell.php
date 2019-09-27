<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\ValueObject\Markdown;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     attributes={"order"={"name"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SpellRepository")
 */
class Spell
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
     * @ApiFilter(SearchFilter::class, strategy="partial")
     * @Groups("read")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MagicSchool", inversedBy="spells")
     * @Groups("read")
     * @ORM\JoinColumn(nullable=false)
     * @ApiSubresource()
     */
    private $school;

    /**
     * @ORM\Column(type="string", length=100)
     * @ApiProperty(identifier=true)
     */
    private $slug;

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
     */
    private $area;

    /**
     * @var ?Markdown
     */
    private $descriptionObject;

    public function getDescriptionObject(): ?Markdown
    {
        return $this->descriptionObject;
    }

    /**
     * @Groups("read")
     *
     * @return ?array
     */
    public function getDescription(): ?array
    {
        if (null === $this->descriptionObject) {
            return null;
        }

        return [
            'markdown' => $this->descriptionObject->getMarkdown(),
            'html' => $this->descriptionObject->getHTML(),
        ];
    }

    public function setDescriptionObject(Markdown $descriptionObject)
    {
        $this->descriptionObject = $descriptionObject;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @Groups("read")
     *
     * @return string|null
     */
    public function getSchoolName(): ?string
    {
        return $this->school->getName() ?? null;
    }

    public function getSchool(): ?MagicSchool
    {
        return $this->school;
    }

    public function setSchool(?MagicSchool $school): self
    {
        $this->school = $school;

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
}
