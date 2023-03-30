<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Entity\TailleStock;
use App\Repository\ProduitsRepository;
use App\Repository\TailleStockRepository;
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

        foreach ($cart as $sneaker => $data) {
            $product = $produitsRepository->find($data['produit']->getId());
            $dataCart[] = [
                'product' => $product,
                'quantity' => $data['quantity'],
                'size' => $data['size']
            ];
            $total += $product->getPrix() * $data['quantity'];
        }

        return $this->render('cart/cart.html.twig', [
            'dataCart' => $dataCart,
            'total' => $total
        ]);
    }

    #[Route('/cart/add/{id}/{size}', name: 'cart_add')]
    public function add(ProduitsRepository $produit, SessionInterface $session, $size, $id)
    {
        $cart = $session->get('cart', []);
        $id = $produit->find($id);
        $cart[$id . '-' . $size]['produit'] = $id;
        $cart[$id . '-' . $size]['size'] = $size;

        if (!empty($cart[$id . '-' . $size]['quantity'])) {
            $cart[$id . '-' . $size]['quantity']++;
        } else {
            $cart[$id . '-' . $size]['quantity'] = 1;
        }

        $session->set('cart', $cart);
        // dd($cart);

        return $this->redirectToRoute('cart_render');
    }

    #[Route('/cart/delete/{id}/{size}', name: 'cart_delete')]
    public function delete(ProduitsRepository $produit, SessionInterface $session, $size, $id)
    {
        $cart = $session->get('cart', []);
        $id = $produit->find($id);

        if (!empty($cart[$id . '-' . $size]['quantity'])) {
            if ($cart[$id . '-' . $size]['quantity'] <= 1) {
                unset($cart[$id . '-' . $size]);
            } else {
                $cart[$id . '-' . $size]['quantity']--;
            }
        }

        $session->set('cart', $cart);
        // dd($cart);

        return $this->redirectToRoute('cart_render');
    }

    #[Route('/cart/remove/{id}/{size}', name: 'cart_remove')]
    public function remove(ProduitsRepository $produit, SessionInterface $session, $size, $id)
    {
        $cart = $session->get('cart', []);
        $id = $produit->find($id);

        if (!empty($cart[$id . '-' . $size])) {
            unset($cart[$id . '-' . $size]);
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
