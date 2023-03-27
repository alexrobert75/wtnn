<?php

namespace App\Entity;

use DateTime;
use App\Entity\User;
use App\Entity\TailleStock;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_commande = null;

    #[ORM\OneToMany(mappedBy: 'id_commande', targetEntity: CommandeProduitTaille::class)]
    private Collection $commandeProduitTailles;

    public function __construct()
    {
        $this->date_commande = new DateTime();
        $this->commandeProduitTailles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;

        return $this;
    }

    /**
     * @return Collection<int, CommandeProduitTaille>
     */
    public function getCommandeProduitTailles(): Collection
    {
        return $this->commandeProduitTailles;
    }

    public function addCommandeProduitTaille(CommandeProduitTaille $commandeProduitTaille): self
    {
        if (!$this->commandeProduitTailles->contains($commandeProduitTaille)) {
            $this->commandeProduitTailles->add($commandeProduitTaille);
            $commandeProduitTaille->setIdCommande($this);
        }

        return $this;
    }

    public function removeCommandeProduitTaille(CommandeProduitTaille $commandeProduitTaille): self
    {
        if ($this->commandeProduitTailles->removeElement($commandeProduitTaille)) {
            // set the owning side to null (unless already changed)
            if ($commandeProduitTaille->getIdCommande() === $this) {
                $commandeProduitTaille->setIdCommande(null);
            }
        }

        return $this;
    }
}
