<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        return ;

    }

}