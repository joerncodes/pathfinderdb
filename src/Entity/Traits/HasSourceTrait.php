<?php

namespace App\Entity\Traits;

use App\Entity\Source;
use Symfony\Component\Serializer\Annotation\Groups;

trait HasSourceTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("read")
     */
    protected $source;

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }
}