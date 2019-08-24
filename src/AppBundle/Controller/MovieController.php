<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends Controller
{

    /**
     * @Route("/movies/display", name="display_movies_from_search", methods={"GET"})
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('browse/load.html.twig');
    }
}
