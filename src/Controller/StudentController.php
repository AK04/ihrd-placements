<?php

namespace App\Controller;
use App\Entity\Student;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    public function studentInfo() {

        $student = new Student();

        $form = $this->createFormBuilder($student)
            ->add('Name', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('Institute', TextType::class, array(
            'attr' => array('class' => 'form-control')
            ))
            ->add('DOB', DateType::class, array(
            'attr' => array('class' => 'form-control')
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
                'attr' => array('class' => 'form-control')
            ))
            ->add('Address', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('MobileNo', NumberType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('$DifferentlyAbled', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => [
                    'No' => 'N',
                    'Yes' => 'Y',
                ]
            ))
            ->add('Address', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('Address', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('Address', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->getForm();




    }

}