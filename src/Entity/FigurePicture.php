<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FigurePictureRepository")
 */
class FigurePicture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="figurePictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdFigure;

    /**
     * @ORM\Column(type="text")
     */
    private $Link;

    public function getId()
    {
        return $this->id;
    }

    public function getIdFigure(): ?Figure
    {
        return $this->IdFigure;
    }

    public function setIdFigure(?Figure $IdFigure): self
    {
        $this->IdFigure = $IdFigure;

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
}
