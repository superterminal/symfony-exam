<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Search;
use AppBundle\Form\SearchType;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use JMS\Serializer\SerializerBuilder;
use Knp\Component\Pager\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends Controller
{

    /**
     * @var RequestServiceInterface
     */
    private $requestService;

    /**
     * @var SerializerServiceInterface
     */
    private $serializerService;

    public function __construct(RequestServiceInterface $requestService,
                                SerializerServiceInterface $serializerService)
    {
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
    }

    /**
     * @Route("/search", name="search_action", methods={"POST", "GET"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);
        $currentInput = $search->getInput();

        $result = $this->requestService->getByQuery($currentInput, $this->container);


        $object = $this->serializerService->deserialize($result, 'AppBundle\Entity\Page')->getResults();

        $movies = [];

        foreach ($object as $movie) {
            $movies[] = $this->serializerService->deserialize(json_encode($movie), 'AppBundle\Entity\Movie');
        }

        /** @var Paginator $paginator */
        $paginator = $this->get('knp_paginator');
        $paginatedMovies = $paginator->paginate(
            $movies,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('browse/load.html.twig', [
            'result' => $paginatedMovies
        ]);
    }
}
