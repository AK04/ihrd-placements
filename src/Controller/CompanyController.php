<?php

namespace App\Controller;

use App\Entity\Company;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController {

    /**
     * @Route("/company", name"company_home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function companyHome() {

        return $this->render('company/home.html.twig');

    }

    /**
     * @Route("/company/info", name="company_info")
     * @Method({GET, POST})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function companyInfo(Request $request) {

        $company = new Company();

        $form = $this->createFormBuilder($company)
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('nature', ChoiceType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('Save', SubmitType::class, array('label' => 'Save', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form = handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {

            $company = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('company_home');

        }

        return $this->render("company/info.html.twig", array('form' => $form->createView()));

    }


}
