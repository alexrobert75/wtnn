<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use App\Repository\CommandesRepository;
use App\Repository\TailleStockRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandeProduitTailleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    #[Route('/security', name: 'app_security')]
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route(path: '/profile', name: 'app_account')]
    public function profile(CommandesRepository $commandeRepo): Response
    {
        $user = $this->security->getUser();
        $id = $user->getId();
        $commandes = $commandeRepo->findBy(['user_id' => $id]);
        return $this->render(
            'security/account.html.twig',
            ['commandes' => $commandes]
        );
    }

    #[Route(path: '/profile/order/{id}', name: 'app_orderdetails')]
    public function orderdetails(CommandesRepository $commandeRepo, CommandeProduitTailleRepository $shoprepo, $id): Response
    {
        $commandelist = $commandeRepo->findBy(['id' => $id]);
        $commande = $commandelist[0];
        $shoppingList = $shoprepo->findBy(['id_commande' => $id]);

        return $this->render(
            'security/orderdetails.html.twig',
            ['commande' => $commande,
            'produits' => $shoppingList]
        );
    }
}