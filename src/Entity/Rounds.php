<?php

namespace App\Entity;

use App\Repository\RoundsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoundsRepository::class)]
class Rounds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $RoundsNumber = null;

    #[ORM\ManyToOne(inversedBy: 'Appliquer')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Theme $letheme = null;

    #[ORM\ManyToOne(inversedBy: 'lesrounds')]
    private ?Games $lapartie = null;

    /**
     * @var Collection<int, Ecrire>
     */
    #[ORM\OneToMany(targetEntity: Ecrire::class, mappedBy: 'id_round')]
    private Collection $lesanecdotes;

    #[ORM\Column(nullable: true)]
    private ?bool $finished = false;

    public function __construct()
    {
        $this->lesanecdotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLapartie(): ?Games
    {
        return $this->lapartie;
    }

    public function setLapartie(?Games $lapartie): static
    {
        $this->lapartie = $lapartie;

        return $this;
    }

    /**
     * @return Collection<int, Ecrire>
     */
    public function getLesanecdotes(): Collection
    {
        return $this->lesanecdotes;
    }

    public function addLesanecdote(Ecrire $lesanecdote): static
    {
        if (!$this->lesanecdotes->contains($lesanecdote)) {
            $this->lesanecdotes->add($lesanecdote);
            $lesanecdote->setIdRound($this);
        }

        return $this;
    }

    public function removeLesanecdote(Ecrire $lesanecdote): static
    {
        if ($this->lesanecdotes->removeElement($lesanecdote)) {
            // set the owning side to null (unless already changed)
            if ($lesanecdote->getIdRound() === $this) {
                $lesanecdote->setIdRound(null);
            }
        }

        return $this;
    }

    public function isFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(?bool $finished): static
    {
        $this->finished = $finished;

        return $this;
    }
}
