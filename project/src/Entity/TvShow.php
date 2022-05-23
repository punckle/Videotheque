<?php

namespace App\Entity;

use App\Repository\TvShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TvShowRepository::class)]
class TvShow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $originalTitle;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $posterPath;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $popularity;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'tvShows')]
    private Collection $types;

    #[ORM\Column(type: 'integer')]
    private int $movieDbId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $year;

    #[ORM\ManyToMany(targetEntity: Actor::class, inversedBy: 'tvShows')]
    private Collection $actors;

    #[ORM\OneToMany(mappedBy: 'tvShow', targetEntity: TvShowUser::class)]
    private Collection $tvShowUsers;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->actors = new ArrayCollection();
        $this->tvShowUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(?string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function setPosterPath(?string $posterPath): self
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function setPopularity(?float $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->types->removeElement($type);

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

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    /**
     * @return Collection<int, TvShowUser>
     */
    public function getTvShowUsers(): Collection
    {
        return $this->tvShowUsers;
    }

    public function addTvShowUser(TvShowUser $tvShowUser): self
    {
        if (!$this->tvShowUsers->contains($tvShowUser)) {
            $this->tvShowUsers[] = $tvShowUser;
            $tvShowUser->setTvShow($this);
        }

        return $this;
    }

    public function removeTvShowUser(TvShowUser $tvShowUser): self
    {
        if ($this->tvShowUsers->removeElement($tvShowUser)) {
            // set the owning side to null (unless already changed)
            if ($tvShowUser->getTvShow() === $this) {
                $tvShowUser->setTvShow(null);
            }
        }

        return $this;
    }
}
