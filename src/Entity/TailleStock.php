<?php

namespace App\Entity;

use App\Repository\TailleStockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TailleStockRepository::class)]
class TailleStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tailleStocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $id_produit = null;

    #[ORM\Column(length: 255)]
    private ?string $taille = null;

    #[ORM\Column(nullable: true)]
    private ?int $stock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduit(): ?Produits
    {
        return $this->id_produit;
    }

    public function setIdProduit(?Produits $id_produit): self
    {
        $this->id_produit = $id_produit;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
}
