<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrickRepository")
 * @UniqueEntity(fields="name", message="La figure existe déjà sur le site internet")
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
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="TrickGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="groupid_id", referencedColumnName="id")
     * })
     */
    private $groupid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="tricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $authorid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="trickid")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="TrickMedia", mappedBy="IdTrick")
     */
    private $trickMedia;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $UpdatedDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TrickMedia", inversedBy="tricks")
     * @ORM\JoinColumn(nullable=true)
     */
    private $CoverMedia;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->trickMedia = new ArrayCollection();
        $this->active = false;
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
            $comment->setTrickid($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getTrickid() === $this) {
                $comment->setTrickid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TrickMedia[]
     */
    public function getTrickMedia(): Collection
    {
        return $this->trickMedia;
    }

    public function addTrickMedia(TrickMedia $trickMedia): self
    {
        if (!$this->trickMedia->contains($trickMedia)) {
            $this->trickMedia[] = $trickMedia;
            $trickMedia->setIdFigure($this);
        }

        return $this;
    }

    public function removeTrickMedia(TrickMedia $trickMedia): self
    {
        if ($this->trickMedia->contains($trickMedia)) {
            $this->trickMedia->removeElement($trickMedia);
            // set the owning side to null (unless already changed)
            if ($trickMedia->getIdFigure() === $this) {
                $trickMedia->setIdFigure(null);
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

    public function getCoverMedia(): ?TrickMedia
    {
        return $this->CoverMedia;
    }

    public function setCoverMedia(?TrickMedia $CoverMedia): self
    {
        $this->CoverMedia = $CoverMedia;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
