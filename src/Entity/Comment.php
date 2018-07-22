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
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $figureid;

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

    public function getFigureid(): ?Figure
    {
        return $this->figureid;
    }

    public function setFigureid(?Figure $figureid): self
    {
        $this->figureid = $figureid;

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
