<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    use Symfony\Component\Routing\Annotation\Route;

    class PlacementController extends AbstractController {
        /**
         * @Route("/", name ="index")
         */
        public function index() {

            $user = $this->getUser();

            if( $user ) {

                $role = $user->getRoles();

                if( $role[0] === "ROLE_STUDENT" )
                    return $this->redirectToRoute("student_home");
                elseif ( $role[0] === "ROLE_INSTITUTE" )
                    return $this->redirectToRoute("institute_home");
                elseif ( $role[0] === "ROLE_COMPANY" )
                    return $this->redirectToRoute("company_home");
                else
                    return $this->render("home/index.html.twig");

            }

            return $this->render("home/index.html.twig");

        }

        

    }