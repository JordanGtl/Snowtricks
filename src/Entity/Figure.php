<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FigureRepository")
 */
class Figure
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
     * @ORM\ManyToOne(targetEntity="App\Entity\FigureGroup", inversedBy="figures")
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

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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

    public function getGroupid(): ?FigureGroup
    {
        return $this->groupid;
    }

    public function setGroupid(?FigureGroup $groupid): self
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
}
