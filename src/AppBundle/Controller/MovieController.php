<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Unwatched;
use AppBundle\Entity\Video;
use AppBundle\Entity\Watched;
use AppBundle\Repository\UnwatchedRepository;
use AppBundle\Repository\WatchedRepository;
use AppBundle\Services\Comment\CommentServiceInterface;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use AppBundle\Services\Unwatched\UnwatchedService;
use AppBundle\Services\Unwatched\UnwatchedServiceInterface;
use AppBundle\Services\Watched\WatchedServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends Controller
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
     * @var CommentServiceInterface
     */
    private $commentService;

    /**
     * @var UnwatchedServiceInterface
     */
    private $unwatchedService;

    /**
     * @var WatchedServiceInterface
     */
    private $watchedService;

    /**
     * MovieController constructor.
     * @param RequestServiceInterface $requestService
     * @param SerializerServiceInterface $serializerService
     * @param CommentServiceInterface $commentService
     * @param UnwatchedServiceInterface $unwatchedService
     * @param WatchedServiceInterface $watchedService
     */
    public function __construct(RequestServiceInterface $requestService, SerializerServiceInterface $serializerService, CommentServiceInterface $commentService, UnwatchedServiceInterface $unwatchedService, WatchedServiceInterface $watchedService)
    {
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
        $this->commentService = $commentService;
        $this->unwatchedService = $unwatchedService;
        $this->watchedService = $watchedService;
    }

    /**
     * @Route("/movies/view/{id}", name="view_movie", methods={"GET"})
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function view($id)
    {
        $movie = $this->requestService->getByMovieId($id, $this->container);

        $mappedMovie = $this->serializerService->deserialize($movie, 'Movie');

        $videoData = json_decode($this->requestService->getVideoData($id, $this->container), true)['results'];
        $videos = $this->serializerService->deserializeData($videoData, 'Video');
        $trailerKey = '';

        $comments = $this->commentService->getAllByMovieId($id);

        $actorsIds = json_decode($this->requestService->getMovieCredits($id, $this->container), true)['cast'];
        $actorsAsObj = $this->requestService->getMovieActors($actorsIds, $this->container);
        $actors = $this->serializerService->deserializeData($actorsAsObj, 'Actor');

        /** @var Video $video */
        foreach ($videos as $video) {
            if ($video->getSite() === 'YouTube' && $video->getType() == 'Trailer') {
                $trailerKey = $video->getKey();
                break;
            }
        }

        return $this->render('movies/view.html.twig', [
            'movie' => $mappedMovie,
            'trailerKey' => $trailerKey,
            'comments' => $comments,
            'actors' => $actors
        ]);
    }


    /**
     * @Route("/movies/view/add_to_unwatched/{id}", name="add_to_unwatched", methods={"POST", "GET"})
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addToUnwatched($id)
    {
        return $this->addToList('AppBundle\Entity\Unwatched',
            $id,
            'Movie added successfully to list: Unwatched',
            'The movie is in your list already',
            $this->unwatchedService);
    }

    /**
     * @Route("/movies/view/add_to_watched/{id}", name="add_to_watched", methods={"POST", "GET"})
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addToWatched($id)
    {
        return $this->addToList('AppBundle\Entity\Watched',
            $id,
            'Movie added successfully to list: Watched',
            'The movie is in your list already',
            $this->watchedService);
    }

    /**
     * @Route("/movies/view/add_to_watched_from_unwatched/{id}", name="add_to_watched_from_unwatched", methods={"POST", "GET"})
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addToWatchedFromUnwatched($id)
    {
        $this->unwatchedService->remove($id);

        $watched = new Watched();

        if (!$this->watchedService->inList($id)) {
            $this->watchedService->insert($watched, $id);
            $this->addFlash('message', 'Movie moved successfully');
        } else {
            $this->addFlash('message', 'Movie is in your watched list already');
        }

        return $this->redirectToRoute('user_profile');
    }

    /**
     * @param $method
     * @param $id
     * @param $successMessage
     * @param $failMessage
     * @param $repository
     * @param $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addToList($method, $id, $successMessage, $failMessage, $service)
    {
        $method = new $method();

        $inStorage = $service->inList($id);

        if ($inStorage) {
            $this->addFlash('list', $failMessage);
            return $this->redirectToRoute('view_movie', ['id' => $id]);
        }

        $service->insert($method, $id);

        $this->addFlash('list', $successMessage);

        return $this->redirectToRoute('view_movie', ['id' => $id]);
    }
}
