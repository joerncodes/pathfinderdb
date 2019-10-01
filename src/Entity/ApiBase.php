<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class ApiBase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ApiProperty(identifier=false)
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read", "read-base"})
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @ApiProperty(identifier=true)
     */
    protected $slug;

    /**
     * @ApiProperty()
     * @Groups({"read", "read-base"})
     */
    public function getType()
    {
        $ref = new \ReflectionClass($this);
        return strtolower($ref->getShortName());
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
}
