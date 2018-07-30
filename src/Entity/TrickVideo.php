<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickVideoRepository")
 */
class TrickVideo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Trick", inversedBy="figureVideos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdFigure;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdPlatform;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $IdVideo;

    public function getId()
    {
        return $this->id;
    }

    public function getIdFigure(): ?Trick
    {
        return $this->IdFigure;
    }

    public function setIdFigure(?Trick $IdFigure): self
    {
        $this->IdFigure = $IdFigure;

        return $this;
    }

    public function getIdPlatform(): ?int
    {
        return $this->IdPlatform;
    }

    public function setIdPlatform(int $IdPlatform): self
    {
        $this->IdPlatform = $IdPlatform;

        return $this;
    }

    public function getIdVideo(): ?string
    {
        return $this->IdVideo;
    }

    public function setIdVideo(string $IdVideo): self
    {
        $this->IdVideo = $IdVideo;

        return $this;
    }
}
