<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_render')]
    public function cart(SessionInterface $session, ProduitsRepository $produitsRepository): Response
    {
        $cart = $session->get('cart', []);
        $dataCart = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $product = $produitsRepository->find($id);
            $dataCart[] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
            $total += $product->getPrix() * $quantity;
        }

        return $this->render('cart/cart.html.twig', [
            'dataCart' => $dataCart,
            'total' => $total
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(Produits $produit, SessionInterface $session)
    {
        $cart = $session->get('cart', []);
        $id = $produit->getId();

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);
        // dd($cart);

        return $this->redirectToRoute('cart_render');
    }

    #[Route('/cart/delete/{id}', name: 'cart_delete')]
    public function delete(Produits $produit, SessionInterface $session)
    {
        $cart = $session->get('cart', []);
        $id = $produit->getId();

        if (!empty($cart[$id])) {
            if ($cart[$id] <= 1) {
                unset($cart[$id]);
            } else {
                $cart[$id]--;
            }
        }

        $session->set('cart', $cart);
        // dd($cart);

        return $this->redirectToRoute('cart_render');
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove(Produits $produit, SessionInterface $session)
    {
        $cart = $session->get('cart', []);
        $id = $produit->getId();

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $session->set('cart', $cart);
        // dd($cart);

        return $this->redirectToRoute('cart_render');
    }

    #[Route('/cart/removeCart', name: 'cart_removeCart')]
    public function removeCart(SessionInterface $session)
    {
        $session->remove('cart');
        return $this->redirectToRoute('cart_render');
    }
}
