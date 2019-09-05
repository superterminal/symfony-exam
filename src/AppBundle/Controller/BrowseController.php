<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Browse;
use AppBundle\Form\BrowseType;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Route("/browse/movies", name="browse_movies_index")
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
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function browseTv()
    {
        return $this->render('browse/browse_tv_shows.html.twig', [
            'genres' => $this->getGenres(),
            'languages' => $this->getLanguages()
        ]);
    }

    /**
     * @Route("/browse/trending/tv", name="browse_trending_tv_index")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function browseTrendingTv(Request $request)
    {
        $paginatedShows = $this->paginatorService->paginate(
            $this->getShows(),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('browse\browse_trending_tv.twig', [
            'shows' => $paginatedShows
        ]);
    }

    /**
     * @Route("/browse/trending/movies", name="browse_trending_movies_index")
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function browseTrendingMovies(Request $request)
    {
        $trendingMovies = $this->requestService->getTrendingMoviesByDay($this->container);

        $moviesAsArray = $this->serializerService->deserialize($trendingMovies, 'Page')->getResults();

        $movies = $this->serializerService->deserializeData($moviesAsArray, 'Movie');

        /** @var Paginator $paginator */
        $paginatedMovies = $this->paginatorService->paginate(
            $movies,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('browse/browse_trending_movies.html.twig', [
            'movies' => $paginatedMovies
        ]);
    }


    /**
     * @Route("/browse/search/movies", name="browse_movies_action", methods={"POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFormDataMovies(Request $request)
    {
        $browse = new Browse();
        $form = $this->createForm(BrowseType::class, $browse);
        $form->handleRequest($request);

        return $this->redirectToRoute('browse_movie_results', [
            'orderBy' => $form->getData()->getOrderBy(),
            'genre' => $form->getData()->getGenre() == null ? '\\' : $form->getData()->getGenre(),
            'releaseYear' => $form->getData()->getReleaseYear() == null ? '\\' : $form->getData()->getReleaseYear(),
            'language' => $form->getData()->getLanguage() == 'xx' ? '\\' : $form->getData()->getLanguage()
        ]);
    }

    /**
     * @Route("/browse/search/tv", name="browse_tv_action", methods={"POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFormDataTv(Request $request)
    {
        $browse = new Browse();
        $form = $this->createForm(BrowseType::class, $browse);
        $form->handleRequest($request);

        return $this->redirectToRoute('browse_tv_results', [
            'orderBy' => $form->getData()->getOrderBy(),
            'genre' => $form->getData()->getGenre() == null ? '\\' : $form->getData()->getGenre(),
            'releaseYear' => $form->getData()->getReleaseYear() == null ? '\\' : $form->getData()->getReleaseYear(),
            'language' => $form->getData()->getLanguage() == 'xx' ? '\\' : $form->getData()->getLanguage()
        ]);
    }

    /**
     * @Route("/browse/movies/results?order_by={orderBy}&genre={genre}&release_year={releaseYear}&lang={language}", name="browse_movie_results", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param null $orderBy
     * @param null $genre
     * @param $language
     * @param null $releaseYear
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchMovieResults(Request $request, $orderBy, $genre, $releaseYear, $language)
    {
        $resultFromApi = $this->requestService->getByFilters('movie', $orderBy, $genre, $releaseYear, $language, $this->container);

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

    /**
     * @Route("/browse/tv/results?order_by={orderBy}&genre={genre}&release_year={releaseYear}&lang={language}", name="browse_tv_results", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param null $orderBy
     * @param null $genre
     * @param $language
     * @param null $releaseYear
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchTvResults(Request $request, $orderBy, $genre, $releaseYear, $language)
    {
        $resultFromApi = $this->requestService->getByFilters('tv', $orderBy, $genre, $releaseYear, $language, $this->container);

        $tvAsArray = $this->serializerService->deserialize($resultFromApi, 'Page')->getResults();

        $tvs = $this->serializerService->deserializeData($tvAsArray, 'TvShow');

        $paginatedTv = $this->paginatorService->paginate(
            $tvs,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 6)
        );

        return $this->render('browse/results_tv.html.twig', [
            'orderBy' => $orderBy,
            'genre' => $genre,
            'result' => $paginatedTv,
        ]);
    }

    /**
     * @return mixed
     */
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
