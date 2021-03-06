<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 * @UniqueEntity(fields="email", message="L'adresse email est déjà utilisée")
 * @UniqueEntity(fields="username", message="Le nom de compte est déjà utilisé")
 */
class Member implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $validationtoken;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $passwordtoken;

    /**
     * @ORM\OneToMany(targetEntity="Trick", mappedBy="authorid")
     */
    private $figures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="authorid")
     */
    private $comments;

    /**
     * @ORM\Column(type="array")
     */
    private $Rank;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg","image/png","image/gif" })
     */
    private $Avatar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    private $saveAvatar;

    public function __construct()
    {
        $this->figures = new ArrayCollection();
        $this->comments = new ArrayCollection();

        $this->Rank = array('ROLE_USER');
        $this->saveAvatar = $this->getAvatar();
        $this->active = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getValidationtoken(): ?string
    {
        return $this->validationtoken;
    }

    public function setValidationtoken(string $validationtoken): self
    {
        $this->validationtoken = $validationtoken;

        return $this;
    }

    public function getPasswordtoken(): ?string
    {
        return $this->passwordtoken;
    }

    public function setPasswordtoken(string $passwordtoken): self
    {
        $this->passwordtoken = $passwordtoken;

        return $this;
    }

    /**
     * @return Collection|Trick[]
     */
    public function getFigures(): Collection
    {
        return $this->figures;
    }

    public function addFigure(Trick $figure): self
    {
        if (!$this->figures->contains($figure)) {
            $this->figures[] = $figure;
            $figure->setAuthorid($this);
        }

        return $this;
    }

    public function removeFigure(Trick $figure): self
    {
        if ($this->figures->contains($figure)) {
            $this->figures->removeElement($figure);
            // set the owning side to null (unless already changed)
            if ($figure->getAuthorid() === $this) {
                $figure->setAuthorid(null);
            }
        }

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
            $comment->setAuthorid($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuthorid() === $this) {
                $comment->setAuthorid(null);
            }
        }

        return $this;
    }

    public function getRank()
    {
        return $this->Rank;
    }

    public function setRank(array $Rank): self
    {
        $this->Rank = $Rank;

        return $this;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function getRoles()
    {
        return $this->Rank;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->active,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->active,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function getAvatar()
    {
        return $this->Avatar;
    }

    public function setAvatar($Avatar): self
    {
        $this->Avatar = $Avatar;

        return $this;
    }

    public function getSaveAvatar()
    {
        return $this->saveAvatar;
    }

    public function setSaveAvatar($Avatar): self
    {
        $this->saveAvatar = $Avatar;

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

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->active;
    }
}
