<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Search;
use AppBundle\Form\SearchType;
use AppBundle\Services\Paginator\PaginatorServiceInterface;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
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
     * @Route("/search", name="search_action", methods={"POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFormData(Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);


        return $this->redirectToRoute('search_results', [
            'query' => $form->getData()->getInput()
        ]);
    }

    /**
     * @Route("/search?query={query}", name="search_results", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param $query
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchResults(Request $request, $query)
    {
        $resultFromApi = $this->requestService->getByQuery($query, $this->container);

        $moviesAsArray = $this->serializerService->deserialize($resultFromApi, 'Page')->getResults();

        $movies = $this->serializerService->deserializeData($moviesAsArray, 'Movie');

        $paginatedMovies = $this->paginatorService->paginate(
            $movies,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('search/load.html.twig', [
            'result' => $paginatedMovies,
        ]);
    }


}
