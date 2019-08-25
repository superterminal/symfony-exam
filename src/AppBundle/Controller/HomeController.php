<?php

namespace AppBundle\Controller;

use AppBundle\Services\Paginator\PaginatorServiceInterface;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
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


    /**
     * @var SerializerServiceInterface
     */
    private $serializerService;

    /**
     * @var PaginatorServiceInterface
     */
    private $paginatorService;


    public function __construct(RequestServiceInterface $requestService,
                                SerializerServiceInterface $serializerService,
                                PaginatorServiceInterface $paginatorService)
    {
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
        $this->paginatorService = $paginatorService;
    }

    /**
     * @Route("/", name="movies_index")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $trendingMovies = $this->requestService->getTrendingMoviesByDay($this->container);

        $moviesAsArray = $this->serializerService->deserialize($trendingMovies, 'Page')->getResults();

        $movies = $this->serializerService->deserializeMovies($moviesAsArray, 'Movie');

        /** @var Paginator $paginator */
        $paginatedMovies = $this->paginatorService->paginate(
            $movies,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('home/index.html.twig', [
            'movies' => $paginatedMovies
        ]);
    }
}
