<?php

namespace App\Entity;

use App\Repository\EcrireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EcrireRepository::class)]
class Ecrire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu = null;

    #[ORM\Column]
    private ?bool $bluffoutell = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'sesannecdotes')]
    private Collection $ecritpar;

    /**
     * @var Collection<int, Rounds>
     */
    #[ORM\OneToMany(targetEntity: Rounds::class, mappedBy: 'lanecdote')]
    private Collection $round;

    public function __construct()
    {
        $this->ecritpar = new ArrayCollection();
        $this->round = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function isBluffoutell(): ?bool
    {
        return $this->bluffoutell;
    }

    public function setBluffoutell(bool $bluffoutell): static
    {
        $this->bluffoutell = $bluffoutell;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getEcritpar(): Collection
    {
        return $this->ecritpar;
    }

    public function addEcritpar(User $ecritpar): static
    {
        if (!$this->ecritpar->contains($ecritpar)) {
            $this->ecritpar->add($ecritpar);
            $ecritpar->setSesannecdotes($this);
        }

        return $this;
    }

    public function removeEcritpar(User $ecritpar): static
    {
        if ($this->ecritpar->removeElement($ecritpar)) {
            // set the owning side to null (unless already changed)
            if ($ecritpar->getSesannecdotes() === $this) {
                $ecritpar->setSesannecdotes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rounds>
     */
    public function getRound(): Collection
    {
        return $this->round;
    }

    public function addRound(Rounds $round): static
    {
        if (!$this->round->contains($round)) {
            $this->round->add($round);
            $round->setLanecdote($this);
        }

        return $this;
    }

    public function removeRound(Rounds $round): static
    {
        if ($this->round->removeElement($round)) {
            // set the owning side to null (unless already changed)
            if ($round->getLanecdote() === $this) {
                $round->setLanecdote(null);
            }
        }

        return $this;
    }
}
