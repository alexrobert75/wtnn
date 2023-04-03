<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AddressFormType;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthentificatorAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
#[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthentificatorAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            // return $userAuthenticator->authenticateUser(
            //     $user,    
            //     $authenticator,
            //     $request
            // );

            $test = "ok";

            return $this->render('registration/test.html.twig', [
                'test' => $test,
            ]);

        }  
        

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/address/{id}', name: 'app_address')]
    public function address(Request $request, EntityManagerInterface $entityManager,$id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $form = $this->createForm(AddressFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_account');
        }

        return $this->render('registration/address.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
