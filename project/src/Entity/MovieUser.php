<?php

namespace App\Entity;

use App\Repository\MovieUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieUserRepository::class)]
class MovieUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Movie::class, inversedBy: 'movieUsers')]
    private ?Movie $movie;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'movieUsers')]
    private ?User $user;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $rate;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(?float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
