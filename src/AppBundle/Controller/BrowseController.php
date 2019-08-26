<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Browse;
use AppBundle\Form\BrowseType;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BrowseController extends Controller
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
     * @var PaginatorInterface
     */
    private $paginatorService;

    public function __construct(RequestServiceInterface $requestService,
                                SerializerServiceInterface $serializerService,
                                PaginatorInterface $paginator)
    {
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
        $this->paginatorService = $paginator;
    }

    /**
     * @Route("/browse", name="browse_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $genres = $this->requestService->getGenres($this->container);

        $genresAsArr = $this->serializerService->deserialize($genres, 'Page')->getGenres();

        $genres = $this->serializerService->deserializeGenres($genresAsArr, 'Genre');

        return $this->render('browse/browse.html.twig', [
            'genres' => $genres
        ]);
    }

    /**
     * @Route("/browse/search", name="browse_action", methods={"POST"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFormData(Request $request)
    {
        $browse = new Browse();
        $form = $this->createForm(BrowseType::class, $browse);
        $form->handleRequest($request);

        return $this->redirectToRoute('browse_results', [
            'orderBy' => $form->getData()->getOrderBy() !== null ? $form->getData()->getOrderBy() : null ,
            'genre' => $form->getData()->getGenre() !== null ? $form->getData()->getGenre() : null
        ]);
    }

    /**
     * @Route("/browse/results/order_by={orderBy}&genre={genre}", name="browse_results", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param null $orderBy
     * @param null $genre
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchResults(Request $request, $orderBy = null, $genre = null)
    {
        $resultFromApi = $this->requestService->getByFilters($orderBy, $genre, $this->container);

        $moviesAsArray = $this->serializerService->deserialize($resultFromApi, 'Page')->getResults();

        $movies = $this->serializerService->deserializeMovies($moviesAsArray, 'Movie');

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
