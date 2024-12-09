<?php

namespace App\Entity;

use App\Repository\ChatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'leschats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $lutilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $senddate = null;

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

    public function getLutilisateur(): ?User
    {
        return $this->lutilisateur;
    }

    public function setLutilisateur(?User $lutilisateur): static
    {
        $this->lutilisateur = $lutilisateur;

        return $this;
    }

    public function getSenddate(): ?string
    {
        return $this->senddate;
    }

    public function setSenddate(string $senddate): static
    {
        $this->senddate = $senddate;

        return $this;
    }
}
