<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController {

    /**
     * @Route("/student", name="student_home")
     * @return Response
     */
    public function studentHome() {

        return $this->render("student/home.html.twig");

    }

    /**
     * @Route("/student/info", name="student_info")
     * @param Request $request
     * @return Response
     */
    public function studentInfo(Request $request) {

        $user = $this->getUser();

        $student = $this->getDoctrine()->getRepository(Student::class)->find($user->getId());

        $form = $this->createFormBuilder($student)
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
            ->add('Name', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('Institute', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('date', TextType::class, array(
                'attr' => array('class' => 'form-control', 'placeholder' => 'dd-mm-yyyy'),
                'label' => 'Date of Birth',
            ))
            ->add('Gender', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Other' => 'Other'
                ]
            ))
            ->add('NativeDistrict', TextType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => 'Native District'
            ))
            ->add('Address', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('MobileNo', NumberType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => 'Mobile Number'
            ))
            ->add('DifferentlyAbled', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => [
                    'No' => 'N',
                    'Yes' => 'Y',
                ]
            ))
            ->add('Course', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => [
                    'Engineering' => 'Engineering',
                    'Something Else' => 'Something else',
                ]
            ))
            ->add('Branch', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => [
                    'Computer Science' => 'Computer science',
                    'Something Else' => 'Something else',
                ]
            ))
            ->add('PassoutYear', NumberType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('SemesterMarks', IntegerType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('Update', SubmitType::class, array('label' => 'Register', 'attr' => array('class' => 'btn btn-primary mt-3')))

            ->getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('student_home');
        }

        return $this->render("student/info.html.twig", array( "update_form_student" => $form->createView() ));

    }

}