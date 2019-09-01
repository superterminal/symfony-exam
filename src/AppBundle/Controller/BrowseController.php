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
     * @Route("/browse/movies", name="browse_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function browseMovies()
    {
        return $this->render('browse/browse.html.twig', [
            'genres' => $this->getGenres(),
            'languages' => $this->getLanguages()
        ]);
    }

    /**
     * @Route("/browse/tv", name="browse_tv_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function browseTv(Request $request)
    {
        $paginatedShows = $this->paginatorService->paginate(
            $this->getShows(),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('browse/browse_tv.html.twig', [
            'shows' => $paginatedShows
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
            'orderBy' => $form->getData()->getOrderBy(),
            'genre' => $form->getData()->getGenre() == null ? '\\' : $form->getData()->getGenre(),
            'releaseYear' => $form->getData()->getReleaseYear() == null ? '\\' : $form->getData()->getReleaseYear(),
            'language' => $form->getData()->getLanguage() == 'xx' ? '\\' : $form->getData()->getLanguage()
        ]);
    }

    /**
     * @Route("/browse/results?order_by={orderBy}&genre={genre}&release_year={releaseYear}&lang={language}", name="browse_results", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param null $orderBy
     * @param null $genre
     * @param $language
     * @param null $releaseYear
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchResults(Request $request, $orderBy, $genre, $releaseYear, $language)
    {
        $resultFromApi = $this->requestService->getByFilters($orderBy, $genre, $releaseYear, $language, $this->container);

        $moviesAsArray = $this->serializerService->deserialize($resultFromApi, 'Page')->getResults();

        $movies = $this->serializerService->deserializeData($moviesAsArray, 'Movie');

        $paginatedMovies = $this->paginatorService->paginate(
            $movies,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('browse/results.html.twig', [
            'orderBy' => $orderBy,
            'genre' => $genre,
            'result' => $paginatedMovies,
        ]);
    }

    public function getShows()
    {
        $shows = $this->requestService->getPopularTvShows($this->container);

        $showsAsArr = $this->serializerService->deserialize($shows, 'Page')->getResults();

        return $this->serializerService->deserializeData($showsAsArr, 'BaseTvShow');
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        $genres = $this->requestService->getGenres($this->container);

        $genresAsArr = $this->serializerService->deserialize($genres, 'Page')->getGenres();

        return $this->serializerService->deserializeData($genresAsArr, 'Genre');
    }

    /**
     * @return mixed
     */
    public function getLanguages()
    {
        $languages = $this->requestService->getLanguages($this->container);

        $languagesAsArr = $this->serializerService->deserializeData(json_decode($languages), 'Language');

        return $languagesAsArr;
    }
}
