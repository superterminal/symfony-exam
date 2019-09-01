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
     * @Route("/", name="home")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $movies = json_decode($this->requestService->getMoviesForHomepage($this->container), true)['results'];

        $pagedMovies = $this->serializerService->deserializeData($movies, 'TrendingMovie');

        $movies = $this->paginatorService->paginate(
            $pagedMovies,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('home/index.html.twig', [
            'user' => $this->getUser(),
            'movies' => $movies
        ]);
    }

}
