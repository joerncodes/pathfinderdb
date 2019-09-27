<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Source extends ApiBase
{
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read")
     */
    private $copyright;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read")
     */
    private $link;

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function setCopyright(string $copyright): self
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
