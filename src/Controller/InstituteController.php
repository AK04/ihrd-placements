<?php

namespace App\Controller;

use App\Entity\Institute;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            ->add('instituteId')

        return $this->render("institute/info.html.twig");

    }

}
