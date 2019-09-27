<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     shortName="school"
 * )
 * @ORM\Entity(repositoryClass="App\Repository\MagicSchoolRepository")
 */
class MagicSchool extends ApiBase
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Spell", mappedBy="school")
     * @ApiSubresource()
     */
    private $spells;

    public function __construct()
    {
        $this->spells = new ArrayCollection();
    }

    public function addSpell(Spell $spell): self
    {
        if (!$this->spells->contains($spell)) {
            $this->spells[] = $spell;
            $spell->setSchool($this);
        }

        return $this;
    }

    public function removeSpell(Spell $spell): self
    {
        if ($this->spells->contains($spell)) {
            $this->spells->removeElement($spell);
            // set the owning side to null (unless already changed)
            if ($spell->getSchool() === $this) {
                $spell->setSchool(null);
            }
        }

        return $this;
    }
}
