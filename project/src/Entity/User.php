<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $avatar;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: MovieUser::class)]
    private Collection $movieUsers;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: TvShowUser::class)]
    private Collection $tvShowUsers;

    public function __construct()
    {
        $this->movieUsers = new ArrayCollection();
        $this->tvShowUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, MovieUser>
     */
    public function getMovieUsers(): Collection
    {
        return $this->movieUsers;
    }

    public function addMovieUser(MovieUser $movieUser): self
    {
        if (!$this->movieUsers->contains($movieUser)) {
            $this->movieUsers[] = $movieUser;
            $movieUser->setUser($this);
        }

        return $this;
    }

    public function removeMovieUser(MovieUser $movieUser): self
    {
        if ($this->movieUsers->removeElement($movieUser)) {
            // set the owning side to null (unless already changed)
            if ($movieUser->getUser() === $this) {
                $movieUser->setUser(null);
            }
        }

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
            $tvShowUser->setUser($this);
        }

        return $this;
    }

    public function removeTvShowUser(TvShowUser $tvShowUser): self
    {
        if ($this->tvShowUsers->removeElement($tvShowUser)) {
            // set the owning side to null (unless already changed)
            if ($tvShowUser->getUser() === $this) {
                $tvShowUser->setUser(null);
            }
        }

        return $this;
    }
}
