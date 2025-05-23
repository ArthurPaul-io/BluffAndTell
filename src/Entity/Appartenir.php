<?php

namespace App\Entity;

use App\Repository\AppartenirRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartenirRepository::class)]
class Appartenir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'usergames')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'gameusers')]
    private ?Games $game = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ready = null;

    #[ORM\Column(nullable: true)]
    private ?int $point_joueur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getGame(): ?Games
    {
        return $this->game;
    }

    public function setGame(?Games $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function isReady(): ?bool
    {
        return $this->ready;
    }

    public function setReady(?bool $ready): static
    {
        $this->ready = $ready;

        return $this;
    }

    public function getPointJoueur(): ?int
    {
        return $this->point_joueur;
    }

    public function setPointJoueur(?int $point_joueur): static
    {
        $this->point_joueur = $point_joueur;

        return $this;
    }
}
