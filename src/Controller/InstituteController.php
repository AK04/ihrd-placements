<?php

namespace App\Controller;

use App\Entity\Institute;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InstituteController extends AbstractController {

    /**
     * @Route("/institute", name="institute_home")
     */
    public function instituteHome() {

        return $this->render("institute/home.html.twig");

    }

    /**
     * @Route("/institute/info", name="institute_info")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function  instituteInfo(Request $request) {

        $institute = new Institute();

        $form = $this->createFormBuilder($institute)
            ->add('InstituteId', NumberType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add("Name", TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add("Location", TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add("Email", EmailType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add("Save", SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {

            $institute = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($institute);
            $entityManager->flush();

            return $this->redirectToRoute('institute_home');

        }

        return $this->render("institute/info.html.twig", array('form' => $form->createView()));

    }

}
