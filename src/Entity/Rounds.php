<?php

namespace App\Entity;

use App\Repository\RoundsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoundsRepository::class)]
class Rounds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Rounds_id = null;

    #[ORM\Column]
    private ?int $RoundsNumber = null;

    #[ORM\ManyToOne(inversedBy: 'Appliquer')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Theme $letheme = null;

    #[ORM\ManyToOne(inversedBy: 'round')]
    private ?Ecrire $lanecdote = null;

    #[ORM\ManyToOne(inversedBy: 'lesrounds')]
    private ?Games $lapartie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoundsId(): ?int
    {
        return $this->Rounds_id;
    }

    public function setRoundsId(int $Rounds_id): static
    {
        $this->Rounds_id = $Rounds_id;

        return $this;
    }

    public function getRoundsNumber(): ?int
    {
        return $this->RoundsNumber;
    }

    public function setRoundsNumber(int $RoundsNumber): static
    {
        $this->RoundsNumber = $RoundsNumber;

        return $this;
    }

    public function getLetheme(): ?Theme
    {
        return $this->letheme;
    }

    public function setLetheme(?Theme $letheme): static
    {
        $this->letheme = $letheme;

        return $this;
    }

    public function getLanecdote(): ?Ecrire
    {
        return $this->lanecdote;
    }

    public function setLanecdote(?Ecrire $lanecdote): static
    {
        $this->lanecdote = $lanecdote;

        return $this;
    }

    public function getLapartie(): ?Games
    {
        return $this->lapartie;
    }

    public function setLapartie(?Games $lapartie): static
    {
        $this->lapartie = $lapartie;

        return $this;
    }
}
