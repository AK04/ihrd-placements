<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Form\UserType;

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

            $this->addFlash('success', 'You have successfully registered!');

            return $this->redirectToRoute('index');

        }

        return $this->render('registration/register.html.twig', [
            'registration_form' => $form->createView(),
        ]);

    }


}