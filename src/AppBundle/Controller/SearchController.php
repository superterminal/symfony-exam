<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Search;
use AppBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends Controller
{

    /**
     * @Route("/search", name="search_action", methods={"GET"})
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search()
    {
        return $this->render('search/index.html.twig');
    }

    /**
     * @Route("/search", methods={"POST"})

     * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        var_dump($search->getInput());
        exit;
    }
}
