<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 */
class Trick
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="TrickGroup", inversedBy="figures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="figures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $authorid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="figureid")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="TrickPicture", mappedBy="IdFigure")
     */
    private $figurePictures;

    /**
     * @ORM\OneToMany(targetEntity="TrickVideo", mappedBy="IdFigure")
     */
    private $figureVideos;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $UpdatedDate;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->figurePictures = new ArrayCollection();
        $this->figureVideos = new ArrayCollection();
    }

    public function getId()
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGroupid(): ?TrickGroup
    {
        return $this->groupid;
    }

    public function setGroupid(?TrickGroup $groupid): self
    {
        $this->groupid = $groupid;

        return $this;
    }

    public function getAuthorid(): ?Member
    {
        return $this->authorid;
    }

    public function setAuthorid(?Member $authorid): self
    {
        $this->authorid = $authorid;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setFigureid($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getFigureid() === $this) {
                $comment->setFigureid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TrickPicture[]
     */
    public function getFigurePictures(): Collection
    {
        return $this->figurePictures;
    }

    public function addFigurePicture(TrickPicture $figurePicture): self
    {
        if (!$this->figurePictures->contains($figurePicture)) {
            $this->figurePictures[] = $figurePicture;
            $figurePicture->setIdFigure($this);
        }

        return $this;
    }

    public function removeFigurePicture(TrickPicture $figurePicture): self
    {
        if ($this->figurePictures->contains($figurePicture)) {
            $this->figurePictures->removeElement($figurePicture);
            // set the owning side to null (unless already changed)
            if ($figurePicture->getIdFigure() === $this) {
                $figurePicture->setIdFigure(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TrickVideo[]
     */
    public function getFigureVideos(): Collection
    {
        return $this->figureVideos;
    }

    public function addFigureVideo(TrickVideo $figureVideo): self
    {
        if (!$this->figureVideos->contains($figureVideo)) {
            $this->figureVideos[] = $figureVideo;
            $figureVideo->setIdFigure($this);
        }

        return $this;
    }

    public function removeFigureVideo(TrickVideo $figureVideo): self
    {
        if ($this->figureVideos->contains($figureVideo)) {
            $this->figureVideos->removeElement($figureVideo);
            // set the owning side to null (unless already changed)
            if ($figureVideo->getIdFigure() === $this) {
                $figureVideo->setIdFigure(null);
            }
        }

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->PublishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $PublishedAt): self
    {
        $this->PublishedAt = $PublishedAt;

        return $this;
    }

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->UpdatedDate;
    }

    public function setUpdatedDate(\DateTimeInterface $UpdatedDate): self
    {
        $this->UpdatedDate = $UpdatedDate;

        return $this;
    }
}
