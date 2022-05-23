<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'string', length: 4)]
    private ?string $year;

    #[ORM\ManyToMany(targetEntity: Director::class, inversedBy: 'movies')]
    private Collection $director;

    #[ORM\ManyToMany(targetEntity: Actor::class, inversedBy: 'movies')]
    private Collection $mainActors;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $synopsis;

    #[ORM\ManyToOne(targetEntity: Platform::class, inversedBy: 'movies')]
    private ?Platform $platform;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $comment;

    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'movies')]
    private Collection $type;

    #[ORM\Column(type: 'integer')]
    private $movieDbId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $originalTitle;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $posterPath;

    #[ORM\Column(type: 'float', nullable: true)]
    private $popularity;

    public function __construct()
    {
        $this->director = new ArrayCollection();
        $this->mainActors = new ArrayCollection();
        $this->type = new ArrayCollection();
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

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection<int, Director>
     */
    public function getDirector(): Collection
    {
        return $this->director;
    }

    public function addDirector(Director $director): self
    {
        if (!$this->director->contains($director)) {
            $this->director[] = $director;
        }

        return $this;
    }

    public function removeDirector(Director $director): self
    {
        $this->director->removeElement($director);

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getMainActors(): Collection
    {
        return $this->mainActors;
    }

    public function addMainActor(Actor $mainActor): self
    {
        if (!$this->mainActors->contains($mainActor)) {
            $this->mainActors[] = $mainActor;
        }

        return $this;
    }

    public function removeMainActor(Actor $mainActor): self
    {
        $this->mainActors->removeElement($mainActor);

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getPlatform(): ?Platform
    {
        return $this->platform;
    }

    public function setPlatform(?Platform $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

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

    /**
     * @return Collection<int, Type>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Type $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        $this->type->removeElement($type);

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
}
