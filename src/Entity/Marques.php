<?php

namespace App\Entity;

use App\Repository\MarquesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarquesRepository::class)]
class Marques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_crea = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $logo = null;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Produits::class)]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCrea(): ?\DateTimeInterface
    {
        return $this->date_crea;
    }

    public function setDateCrea(?\DateTimeInterface $date_crea): self
    {
        $this->date_crea = $date_crea;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setMarque($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getMarque() === $this) {
                $produit->setMarque(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
