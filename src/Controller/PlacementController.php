<?php

    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;

    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

    class PlacementController extends Controller {
        /**
         * @Route("/")
         */
        public function index() {

            return $this->render("home/index.html.twig");

        }



    }