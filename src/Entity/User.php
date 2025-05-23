<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pseudo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdaccount = null;

    /**
     * @var Collection<int, Chat>
     */
    #[ORM\OneToMany(targetEntity: Chat::class, mappedBy: 'lutilisateur')]
    private Collection $leschats;

    /**
     * @var Collection<int, Appartenir>
     */
    #[ORM\OneToMany(targetEntity: Appartenir::class, mappedBy: 'user')]
    private Collection $usergames;

    /**
     * @var Collection<int, Theme>
     */
    #[ORM\OneToMany(targetEntity: Theme::class, mappedBy: 'createur')]
    private Collection $themecreer;

    /**
     * @var Collection<int, Ecrire>
     */
    #[ORM\OneToMany(targetEntity: Ecrire::class, mappedBy: 'ecrivain')]
    private Collection $plusieursanecdotes;

    public function __construct()
    {
        $this->leschats = new ArrayCollection();
        $this->usergames = new ArrayCollection();
        $this->themecreer = new ArrayCollection();
        $this->plusieursanecdotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // garantit que chaque utilisateur a au moins ROLE_USER
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
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

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getCreatedaccount(): ?\DateTimeInterface
    {
        return $this->createdaccount;
    }

    public function setCreatedaccount(?\DateTimeInterface $createdaccount): static
    {
        $this->createdaccount = $createdaccount;

        return $this;
    }

    /**
     * @return Collection<int, Chat>
     */
    public function getLeschats(): Collection
    {
        return $this->leschats;
    }

    public function addLeschat(Chat $leschat): static
    {
        if (!$this->leschats->contains($leschat)) {
            $this->leschats->add($leschat);
            $leschat->setLutilisateur($this);
        }

        return $this;
    }

    public function removeLeschat(Chat $leschat): static
    {
        if ($this->leschats->removeElement($leschat)) {
            // set the owning side to null (unless already changed)
            if ($leschat->getLutilisateur() === $this) {
                $leschat->setLutilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appartenir>
     */
    public function getUsergames(): Collection
    {
        return $this->usergames;
    }

    public function addUsergame(Appartenir $usergame): static
    {
        if (!$this->usergames->contains($usergame)) {
            $this->usergames->add($usergame);
            $usergame->setUser($this);
        }

        return $this;
    }

    public function removeUsergame(Appartenir $usergame): static
    {
        if ($this->usergames->removeElement($usergame)) {
            // set the owning side to null (unless already changed)
            if ($usergame->getUser() === $this) {
                $usergame->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Theme>
     */
    public function getThemecreer(): Collection
    {
        return $this->themecreer;
    }

    public function addThemecreer(Theme $themecreer): static
    {
        if (!$this->themecreer->contains($themecreer)) {
            $this->themecreer->add($themecreer);
            $themecreer->setCreateur($this);
        }

        return $this;
    }

    public function removeThemecreer(Theme $themecreer): static
    {
        if ($this->themecreer->removeElement($themecreer)) {
            // set the owning side to null (unless already changed)
            if ($themecreer->getCreateur() === $this) {
                $themecreer->setCreateur(null);
            }
        }

        return $this;
    }


    public function __ToString(){
        return $this->email;
    }

    /**
     * @return Collection<int, Ecrire>
     */
    public function getPlusieursanecdotes(): Collection
    {
        return $this->plusieursanecdotes;
    }

    public function addPlusieursanecdote(Ecrire $plusieursanecdote): static
    {
        if (!$this->plusieursanecdotes->contains($plusieursanecdote)) {
            $this->plusieursanecdotes->add($plusieursanecdote);
            $plusieursanecdote->setEcrivain($this);
        }

        return $this;
    }

    public function removePlusieursanecdote(Ecrire $plusieursanecdote): static
    {
        if ($this->plusieursanecdotes->removeElement($plusieursanecdote)) {
            // set the owning side to null (unless already changed)
            if ($plusieursanecdote->getEcrivain() === $this) {
                $plusieursanecdote->setEcrivain(null);
            }
        }

        return $this;
    }
}
