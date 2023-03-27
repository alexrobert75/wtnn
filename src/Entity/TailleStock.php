<?php

namespace App\Entity;

use App\Entity\Commandes;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleStockRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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

    #[ORM\OneToMany(mappedBy: 'id_prod_taille', targetEntity: CommandeProduitTaille::class)]
    private Collection $commandeProduitTailles;

    public function __construct()
    {
        $this->commandeProduitTailles = new ArrayCollection();
    }
    
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
            $commandeProduitTaille->setIdProdTaille($this);
        }

        return $this;
    }

    public function removeCommandeProduitTaille(CommandeProduitTaille $commandeProduitTaille): self
    {
        if ($this->commandeProduitTailles->removeElement($commandeProduitTaille)) {
            // set the owning side to null (unless already changed)
            if ($commandeProduitTaille->getIdProdTaille() === $this) {
                $commandeProduitTaille->setIdProdTaille(null);
            }
        }

        return $this;
    }
}
