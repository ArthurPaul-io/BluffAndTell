<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'themecreer')]
    private ?User $createur = null;

    /**
     * @var Collection<int, Rounds>
     */
    #[ORM\OneToMany(targetEntity: Rounds::class, mappedBy: 'letheme')]
    private Collection $Appliquer;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->Appliquer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection<int, Rounds>
     */
    public function getAppliquer(): Collection
    {
        return $this->Appliquer;
    }

    public function addAppliquer(Rounds $appliquer): static
    {
        if (!$this->Appliquer->contains($appliquer)) {
            $this->Appliquer->add($appliquer);
            $appliquer->setLetheme($this);
        }

        return $this;
    }

    public function removeAppliquer(Rounds $appliquer): static
    {
        if ($this->Appliquer->removeElement($appliquer)) {
            // set the owning side to null (unless already changed)
            if ($appliquer->getLetheme() === $this) {
                $appliquer->setLetheme(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }


}
