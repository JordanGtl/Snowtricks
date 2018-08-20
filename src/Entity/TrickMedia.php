<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
     * @ORM\Column(type="string", name="link", nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg","image/png","image/gif" })
     */
    private $Link;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trick", mappedBy="CoverMedia")
     */
    private $tricks;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $VideoEmbed;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    private $tempLink;

    public function __construct()
    {
        $this->tricks = new ArrayCollection();
    }

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

    public function getLink()
    {
        return $this->Link;
    }

    public function setLink($Link): self
    {
        $this->Link = $Link;

        return $this;
    }

    public function getTempLink() : ?string
    {
        return $this->tempLink;
    }

    public function setTempLink($tempLink): self
    {
        $this->tempLink = $tempLink;

        return $this;
    }

    /**
     * @return Collection|Trick[]
     */
    public function getTricks(): Collection
    {
        return $this->tricks;
    }

    public function addTrick(Trick $trick): self
    {
        if (!$this->tricks->contains($trick)) {
            $this->tricks[] = $trick;
            $trick->setCoverMedia($this);
        }

        return $this;
    }

    public function removeTrick(Trick $trick): self
    {
        if ($this->tricks->contains($trick)) {
            $this->tricks->removeElement($trick);
            // set the owning side to null (unless already changed)
            if ($trick->getCoverMedia() === $this) {
                $trick->setCoverMedia(null);
            }
        }

        return $this;
    }

    public function getVideoEmbed(): ?string
    {
        return $this->VideoEmbed;
    }

    public function setVideoEmbed(?string $VideoEmbed): self
    {
        $this->VideoEmbed = $VideoEmbed;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
