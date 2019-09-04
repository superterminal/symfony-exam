<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use AppBundle\Entity\Search;
use AppBundle\Form\SearchType;
use AppBundle\Services\Paginator\PaginatorServiceInterface;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Route("/search/movie", name="search_action", methods={"POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMovieFormData(Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        return $this->redirectToRoute('search_results', [
            'query' => $form->getData()->getInput()
        ]);
    }

    /**
     * @Route("/search/movie/?query={query}", name="search_results", methods={"GET", "POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @param $query
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchMovieResults(Request $request, $query)
    {
        $resultFromApi = $this->requestService->getByQuery($query, $this->container);

        $moviesAsArray = $this->serializerService->deserialize($resultFromApi, 'Page')->getResults();

        $movies = $this->serializerService->deserializeData($moviesAsArray, 'Movie');

        usort($movies, function(Movie $a, Movie $b) use($movies) {
           return $b->getPopularity() <=> $a->getPopularity();
        });

        $paginatedMovies = $this->paginatorService->paginate(
            $movies,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('search/load.html.twig', [
            'result' => $paginatedMovies,
        ]);
    }

    /**
     * @Route("/search/tv", name="search_tv_action", methods={"POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getTvFormData(Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        return $this->redirectToRoute('search_tv_results', [
            'query' => $form->getData()->getInput()
        ]);
    }

    /**
     * @Route("/search/tv/?query={query}", name="search_tv_results", methods={"GET", "POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @param $query
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchTvResults(Request $request, $query)
    {
        $resultFromApi = $this->requestService->searchByTvName($query, $this->container);

        $tvSeries = $this->serializerService->deserialize($resultFromApi, 'Page')->getResults();

        $tv = $this->serializerService->deserializeData($tvSeries, 'BaseTvShow');

        $paginatedMovies = $this->paginatorService->paginate(
            $tv,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('search/load_tv.html.twig', [
            'result' => $paginatedMovies,
        ]);
    }


}
