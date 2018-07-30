<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickPictureRepository")
 */
class TrickMedia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Trick", inversedBy="trickMedia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdTrick;

    /**
     * @ORM\Column(type="text")
     */
    private $Link;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    public function getId()
    {
        return $this->id;
    }

    public function getIdFigure(): ?Trick
    {
        return $this->IdTrick;
    }

    public function setIdFigure(?Trick $IdTrick): self
    {
        $this->IdTrick = $IdTrick;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->Link;
    }

    public function setLink(string $Link): self
    {
        $this->Link = $Link;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
