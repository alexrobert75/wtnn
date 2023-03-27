<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\ProductSearch;
use App\Form\ProductSearchType;
use App\Repository\MarquesRepository;
use App\Repository\ProduitsRepository;
use App\Repository\TailleStockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProduitsRepository $produitsRepository): Response
    {
        $produits = $produitsRepository->findAll();
        return $this->render('home/index.html.twig', [
            'produits' => $produits
        ]);
    }

    #[Route('/brands', name: 'app_brands')]
    public function brands(MarquesRepository $marquesRepository): Response
    {
        $marques = $marquesRepository->findAll();
        return $this->render('home/brands.html.twig', [
            'marques' => $marques
        ]);
    }

    #[Route('/products/{brand}', name: 'app_products')]
    public function products(ProduitsRepository $produitsRepository, EntityManagerInterface $entityManager, $brand, Request $request): Response
    {
        $search = new ProductSearch();
        $form = $this->createForm(ProductSearchType::class, $search);
        $form->handleRequest($request);

        $produits = $entityManager->getRepository(Produits::class)->findBy(['marque' => $brand]);
        return $this->render('home/products.html.twig', [
            'produits' => $produits,
            'form' => $form->createView()
        ]);
    }

    #[Route('/products', name: 'app_prod')]
    public function prod(ProduitsRepository $produitsRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $search = new ProductSearch();
        $form = $this->createForm(ProductSearchType::class, $search);
        $form->handleRequest($request);
        $produits = $entityManager->getRepository(Produits::class)->findAll();
        return $this->render('home/products.html.twig', [
            'produits' => $produits,
            'form' => $form->createView()
        ]);
    }

    #[Route('/ficheproduct/{id}', name: 'app_ficheProduct')]
    public function ficheProduct(ProduitsRepository $produitsRepository, $id, TailleStockRepository $tailleStockRepository): Response
    {
        $produit = $produitsRepository->find($id);
        $tailleP = $tailleStockRepository->findBy(['id_produit' => $produit->getId()]);


        $tableSize = [];
        foreach ($tailleP as $sneaker => $value) {
            $tableSize[] = $value->getTaille();
        }
        asort($tableSize);

        return $this->render('home/ficheProduct.html.twig', [
            'produit' => $produit,
            'tableSize' => $tableSize,
            'tailleProduct' => $tailleP
        ]);
    }
}
