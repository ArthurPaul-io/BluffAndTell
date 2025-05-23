<?php

namespace App\Entity;
use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesRepository::class)]
class Games
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column]
    private ?int $RoundCount = null;

    #[ORM\Column(length: 255)]
    private ?string $GameStatut = null;

    /**
     * @var Collection<int, Appartenir>
     */
    #[ORM\OneToMany(targetEntity: Appartenir::class, mappedBy: 'game', cascade: ['remove'])]
    private Collection $gameusers;

    /**
     * @var Collection<int, Rounds>
     */
    #[ORM\OneToMany(targetEntity: Rounds::class, mappedBy: 'lapartie',  cascade: ['remove'])]
    private Collection $lesrounds;

   // #[ORM\Column(length: 255, nullable: true)]
   #[ORM\ManyToOne()]
    private ?User $CreatedBy = null;

    public function __construct()
    {
        $this->gameusers = new ArrayCollection();
        $this->lesrounds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    

    public function getRoundCount(): ?int
    {
        return $this->RoundCount;
    }

    public function setRoundCount(int $RoundCount): static
    {
        $this->RoundCount = $RoundCount;

        return $this;
    }

    public function getGameStatut(): ?string
    {
        return $this->GameStatut;
    }

    public function setGameStatut(string $GameStatut): static
    {
        $this->GameStatut = $GameStatut;

        return $this;
    }



    /**
     * @return Collection<int, Appartenir>
     */
    public function getGameusers(): Collection
    {
        return $this->gameusers;
    }

    public function addGameuser(Appartenir $gameuser): static
    {
        if (!$this->gameusers->contains($gameuser)) {
            $this->gameusers->add($gameuser);
            $gameuser->setGame($this);
        }

        return $this;
    }

    public function removeGameuser(Appartenir $gameuser): static
    {
        if ($this->gameusers->removeElement($gameuser)) {
            // set the owning side to null (unless already changed)
            if ($gameuser->getGame() === $this) {
                $gameuser->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rounds>
     */
    public function getLesrounds(): Collection
    {
        return $this->lesrounds;
    }

    public function addLesround(Rounds $lesround): static
    {
        if (!$this->lesrounds->contains($lesround)) {
            $this->lesrounds->add($lesround);
            $lesround->setLapartie($this);
        }

        return $this;
    }

    public function removeLesround(Rounds $lesround): static
    {
        if ($this->lesrounds->removeElement($lesround)) {
            // set the owning side to null (unless already changed)
            if ($lesround->getLapartie() === $this) {
                $lesround->setLapartie(null);
            }
        }

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->CreatedBy;
    }

    public function setCreatedBy(?User $CreatedBy): static
    {
        $this->CreatedBy = $CreatedBy;

        return $this;
    }

    /**
     * Get the players associated with this game.
     *
     * @return Collection<int, User>
     */
    public function getPlayers(): Collection
    {
        return $this->gameusers->map(fn(Appartenir $appartenir) => $appartenir->getUser());
    }
}
