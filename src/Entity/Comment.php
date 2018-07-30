<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Trick", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trickid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $authorid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedate;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    public function getId()
    {
        return $this->id;
    }

    public function getTrickid(): ?Trick
    {
        return $this->trickid;
    }

    public function setTrickid(?Trick $trickid): self
    {
        $this->trickid = $trickid;

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

    public function getUpdatedate(): ?\DateTimeInterface
    {
        return $this->updatedate;
    }

    public function setUpdatedate(\DateTimeInterface $updatedate): self
    {
        $this->updatedate = $updatedate;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
