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
     * @ORM\Column(type="string", name="link")
     * @Assert\File(mimeTypes={ "image/jpeg","image/png","image/gif" })
     */
    private $Link;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trick", mappedBy="CoverMedia")
     */
    private $tricks;

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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

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
}
