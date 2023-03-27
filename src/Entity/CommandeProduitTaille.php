<?php

namespace App\Entity;

use App\Repository\CommandeProduitTailleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeProduitTailleRepository::class)]
class CommandeProduitTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandeProduitTailles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commandes $id_commande = null;

    #[ORM\ManyToOne(inversedBy: 'commandeProduitTailles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TailleStock $id_prod_taille = null;

    #[ORM\Column]
    private ?int $quantite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCommande(): ?Commandes
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commandes $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getIdProdTaille(): ?TailleStock
    {
        return $this->id_prod_taille;
    }

    public function setIdProdTaille(?TailleStock $id_prod_taille): self
    {
        $this->id_prod_taille = $id_prod_taille;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
