<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Institute;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Student;
use App\Entity\User;
use App\Form\UserType;


use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RegistrationController extends Controller {

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request) {

        return $this->render('registration/register.html.twig');

    }

    /**
     * @Route("/register/student", name="register_student")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function registerStudent(Request $request) {

        $student = new Student();

        $institutesRepo = $this->getDoctrine()->getRepository(Institute::class);

        $institutes = $institutesRepo->findAll();

        $instituteNames = array();

        foreach ( $institutes as $institute ) {
            $instituteNames[$institute->getName()] = $institute->getName();
        }

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
            ->add('Institute', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => $instituteNames,
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
            ->add('Register', SubmitType::class, array('label' => 'Register', 'attr' => array('class' => 'btn btn-primary mt-3')))

            ->getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()) {

            $details = $form->getData();

            dump($details);

            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $student,
                    $student->getPlainPassword()
                )
            ;

            $date = $student->getDate();

            $student->setDOB($date);

            $student->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($student);
            $entityManager->flush();

            $token = new UsernamePasswordToken(
                $student,
                $password,
                'main',
                $student->getRoles()
            );

            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            $this->addFlash('success', 'You have successfully registered!');

            return $this->redirectToRoute('student_home');

        }

        return $this->render('registration/student.html.twig', [
            'registration_form_student' => $form->createView(),
        ]);


    }


    /**
     * @Route("/register/company", name="register_company")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function registerCompany(Request $request) {

        $company = new Company();

        $form = $this->createFormBuilder($company)
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
            ->add('name', TextType::class, array(
                'label' => "Company Name",
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('nature', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'required' => true,
                'choices' => [
                    'Computer Science' => 'Computer Science',
                    'Electronics' => 'Electronics'
                ]
            ))
            ->add('email', EmailType::class, array(
                'attr' => array('class' => 'form-control'),
                'required' => true
            ))
            ->add('Save', SubmitType::class, array(
                'label' => 'Register',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {

            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $company,
                    $company->getPlainPassword()
                )
            ;

            $company->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($company);
            $entityManager->flush();

            $token = new UsernamePasswordToken(
                $company,
                $password,
                'main',
                $company->getRoles()
            );

            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            $this->addFlash('success', 'You have successfully registered!');

            return $this->redirectToRoute('company_home');

        }

        return $this->render('registration/company.html.twig', array('registration_form_company' => $form->createView()));

    }

    /**
     * @Route("/register/institute", name="register_institute")
     * @param Request $request
     * @return Response
     */
    public function registerInstitute(Request $request) {

        $institute = new Institute();

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
                'label' => "Institute Name",
                'attr' => array('class' => 'form-control')
            ))
            ->add("Location", TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add("Email", EmailType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add("Save", SubmitType::class, array(
                'label' => 'Register',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {

            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $institute,
                    $institute->getPlainPassword()
                )
            ;

            $institute->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($institute);
            $entityManager->flush();

            $token = new UsernamePasswordToken(
                $institute,
                $password,
                'main',
                $institute->getRoles()
            );

            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            $this->addFlash('success', 'You have successfully registered!');

            return $this->redirectToRoute('institute_home');

        }

        return $this->render("registration/institute.html.twig", array('registration_form_institute' => $form->createView()));

    }


}