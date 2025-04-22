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
     * @var Collection<int, Rounds>
     */
    #[ORM\OneToMany(targetEntity: Rounds::class, mappedBy: 'lanecdote')]
    private Collection $round;

    #[ORM\ManyToOne(inversedBy: 'lesanecdotes')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Rounds $id_round = null;

    #[ORM\ManyToOne(inversedBy: 'plusieursanecdotes')]
    private ?User $ecrivain = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_point = null;

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

    public function getIdRound(): ?Rounds
    {
        return $this->id_round;
    }

    public function setIdRound(?Rounds $id_round): static
    {
        $this->id_round = $id_round;

        return $this;
    }

    public function getEcrivain(): ?User
    {
        return $this->ecrivain;
    }

    public function setEcrivain(?User $ecrivain): static
    {
        $this->ecrivain = $ecrivain;

        return $this;
    }

    public function getNbPoint(): ?int
    {
        return $this->nb_point;
    }

    public function setNbPoint(?int $nb_point): static
    {
        $this->nb_point = $nb_point;

        return $this;
    }
}
