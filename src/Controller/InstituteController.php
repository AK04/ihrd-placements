<?php

namespace App\Controller;

use App\Entity\Institute;
use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @return Response
     */
    public function  instituteInfo(Request $request) {

        $user = $this->getUser();

        $institute = $this->getDoctrine()->getRepository(Institute::class)->find($user->getId());

        $form = $this->createFormBuilder($institute)
            ->add('username', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => "Password",
                ],
                'second_options' => [
                    'label' => 'Repeat Password'
                ],
                'options' => ['attr' => array('class' => 'form-control') ],
                'required' => true
            ])
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

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('institute_home');
        }

        return $this->render("institute/info.html.twig", array('form' => $form->createView()));

    }

    /**
     * @Route("/institute/unapproved", name="institute_unapproved")
     */
    public function unapprovedStudents() {

        $repository = $this->getDoctrine()->getRepository(Student::class);

        $user = $this->getUser();

        $unapproved = $repository->findOneBy([
            'Institute' => $user->getName(),
            'approved' => 0
        ]);

        return $this->render("institute/unapproved.html.twig", [
            'unapproved' => $unapproved
        ]);

    }

}
