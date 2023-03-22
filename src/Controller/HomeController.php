<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\ProductSearch;
use App\Form\ProductSearchType;
use App\Repository\MarquesRepository;
use App\Repository\ProduitsRepository;
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
}
