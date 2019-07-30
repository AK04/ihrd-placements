<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RegistrationController extends Controller {

    /**
     * @Route("/register", name="registeration")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request) {

        $user = new User();

        $form = $this->createForm(UserType::class, $user, [

        ]);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()) {

            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $user,
                    $user->getPlainPassword()
                    )
            ;

            $user->setPassword($password);
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->flush();

            $token = new UsernamePasswordToken(
                $user,
                $password,
                'main',
                $user->getRoles()
            );

            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            $this->addFlash('success', 'You have successfully registered!');

            return $this->redirectToRoute('index');

        }

        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
        ]);

    }


}