<?php

namespace AppBundle\Controller;

use AppBundle\Services\Request\RequestServiceInterface;
use JMS\Serializer\SerializerBuilder;
use Knp\Component\Pager\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{

    /**
     * @var RequestServiceInterface
     */
    private $requestService;

    public function __construct(RequestServiceInterface $requestService)
    {
        $this->requestService = $requestService;
    }

    /**
     * @Route("/", name="movies_index")
     */
    public function indexAction()
    {
        $trendingMovies = $this->requestService->getTrendingMoviesByDay($this->container);
        $serializer = SerializerBuilder::create()->build();
        $moviesAsArray = $serializer->deserialize($trendingMovies, 'AppBundle\Entity\Page', 'json')->getResults();

        foreach ($moviesAsArray as $movie) {
            $movies[] = $serializer->deserialize(json_encode($movie), 'AppBundle\Entity\TrendingMovie', 'json');
        }

        /** @var Paginator $paginator */
        $paginator = $this->get('knp_paginator');
        $paginatedMovies = $paginator->paginate(
            $movies,
            1,
            3
        );

        return $this->render('home/index.html.twig', [
            'movies' => $paginatedMovies
        ]);
    }
}
