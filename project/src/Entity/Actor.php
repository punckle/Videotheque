<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'mainActors')]
    private Collection $movies;

    #[ORM\Column(type: 'integer')]
    private int $movieDbId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $name;

    #[ORM\ManyToMany(targetEntity: TvShow::class, mappedBy: 'actors')]
    private Collection $tvShows;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
        $this->tvShows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->addMainActor($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->removeElement($movie)) {
            $movie->removeMainActor($this);
        }

        return $this;
    }

    public function getMovieDbId(): ?int
    {
        return $this->movieDbId;
    }

    public function setMovieDbId(int $movieDbId): self
    {
        $this->movieDbId = $movieDbId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, TvShow>
     */
    public function getTvShows(): Collection
    {
        return $this->tvShows;
    }

    public function addTvShow(TvShow $tvShow): self
    {
        if (!$this->tvShows->contains($tvShow)) {
            $this->tvShows[] = $tvShow;
            $tvShow->addActor($this);
        }

        return $this;
    }

    public function removeTvShow(TvShow $tvShow): self
    {
        if ($this->tvShows->removeElement($tvShow)) {
            $tvShow->removeActor($this);
        }

        return $this;
    }
}
