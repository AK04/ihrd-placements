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

            return new Response("<html> <body> <h1> Login underconstruction </h1> </body> </html>");

        }



    }