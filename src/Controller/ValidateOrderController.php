<?php

namespace App\Controller;

use App\Entity\CommandeProduitTaille;
use App\Entity\Commandes;
use App\Entity\TailleStock;
use App\Repository\ProduitsRepository;
use App\Repository\TailleStockRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ValidateOrderController extends AbstractController
{
    #[Route('/validate', name: 'app_checkout')]
    public function index(SessionInterface $session, TailleStockRepository $tailleStockRepository, ProduitsRepository $produitsRepository, UserRepository $userRepository, EntityManagerInterface $manager): Response
    {
        $cart = $session->get('cart', []);
        if (empty($cart)) {
            return  $this->redirectToRoute('cart_render');
        }

        $pbStock = 0;

        foreach ($cart as $sneaker => $data) {
            $id_product = $data['produit']->getId();
            $size = $data['size'];
            $quantity = $data['quantity'];

            $tailleStock = $tailleStockRepository->findOneBy(['id_produit' => $id_product, 'taille' => $size]);
            // dd($tailleStock);
            if (!$tailleStock || $quantity > $tailleStock->getStock()) {
                $pbStock++;
                $cart[$sneaker]['quantity'] = $tailleStock ? $tailleStock->getStock() : 0;
                $this->addFlash('error', 'Limited stock, quantity updated');
                $session->set('cart', $cart);
                return $this->redirectToRoute('cart_render');
            }
        }

        $session->set('cart', $cart);


        $total = 0;

        if ($pbStock != 0) {
            return $this->redirectToRoute('cart_render');
        } else {
            foreach ($cart as $sneaker => $data) {
                $product = $produitsRepository->find($data['produit']->getId());
                $total += $product->getPrix() * $data['quantity'];
            }
            // dd(($userRepository->findOneBy(['email' => $session->get('_security.last_username')]))->getId());
            // dd($total);

            $user = $userRepository->findOneBy(['email' => $session->get('_security.last_username')]);
            $commande = new Commandes;
            $commande->setUserId($user);
            $commande->setStatut('In progress');
            $commande->setMontant($total);
            $commande->setDateCommande(new \DateTimeImmutable('Europe/Paris'));
            $manager->persist($commande);

            foreach ($cart as $sneaker => $data) {
                $product = $produitsRepository->find($data['produit']->getId());
                $size = $data['size'];
                $quantity = $data['quantity'];

                $tailleStock = $tailleStockRepository->findOneBy(['id_produit' => $product->getId(), 'taille' => $size]);
                $tailleStock->setStock($tailleStock->getStock() - $quantity);
                $manager->persist($tailleStock);

                $commandeProduitTaille = new CommandeProduitTaille;
                $commandeProduitTaille->setIdCommande($commande);
                $commandeProduitTaille->setIdProdTaille($tailleStock);
                $commandeProduitTaille->setQuantite($quantity);
                $manager->persist($commandeProduitTaille);
            }
        }

        $manager->flush();

        $session->set('cart', []);

        return $this->redirectToRoute('app_account');
    }
}
