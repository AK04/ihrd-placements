<?php

namespace App\Controller;

use App\Entity\Company;

use App\Entity\Institute;
use App\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController {

    /**
     * @Route("/company", name="company_home")
     * @return Response
     */
    public function companyHome() {

        return $this->render('company/home.html.twig');

    }

    /**
     * @Route("/company/info", name="company_info")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function companyInfo(Request $request) {

        $user = $this->getUser();

        $company = $this->getDoctrine()->getRepository(Company::class)->find($user->getId());

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
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('company_home');
        }

        return $this->render("company/info.html.twig", array('form' => $form->createView()));

    }

    /**
     * @Route("/company/search-students/", name="company_search_students")
     * @param Request $request
     * @return Response
     */
    public function searchStudents(Request $request) {

        $institutesRepo = $this->getDoctrine()->getRepository(Institute::class);

        $studentsRepo = $this->getDoctrine()->getRepository(Student::class);

        $students = $studentsRepo->findAll();

        $institutes = $institutesRepo->findAll();

        $instituteNames = array();
        $courseNames = array();
        $branchNames = array();
        $gender = array("Any" => "Any");
        $district = array();

        foreach ( $institutes as $institute ) {
            $instituteNames[$institute->getName()] = $institute->getName();
        }

        foreach ( $students as $student ) {
            $courseNames[$student->getCourse()] = $student->getCourse();
            $branchNames[$student->getBranch()] = $student->getBranch();
            $gender[$student->getGender()] = $student->getGender();
            $district[$student->getNativeDistrict()] = $student->getNativeDistrict();
        }

        $form = $this->createFormBuilder()
            ->add('Semester_marks', IntegerType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => 'Minimum Semester Marks',
            ))
            ->add('Course', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => $courseNames,
            ))
            ->add('Branch', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => $branchNames,
            ))
            ->add('Institute', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => $instituteNames,
            ))->add('Gender', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => $gender,
            ))
            ->add('District', ChoiceType::class, array(
                'attr' => array('class' => 'form-control'),
                'choices' => $district,
            ))
            ->add('Save', SubmitType::class, array(
                'label' => 'Search',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {

            $query = $form->getData();

            $students = $this->getDoctrine()->getRepository(Student::class)->findStudents($query["Semester_marks"], $query["Course"], $query["Branch"], $query["Institute"], $query["Gender"], $query["District"] );

            return $this->render("/company/search.html.twig", array('form' => null, 'students' => $students));
        }

        return $this->render("/company/search.html.twig", array('form' => $form->createView()));

    }


}
