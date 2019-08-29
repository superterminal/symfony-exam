<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
use AppBundle\Services\Comment\CommentServiceInterface;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
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
     * MovieController constructor.
     * @param RequestServiceInterface $requestService
     * @param SerializerServiceInterface $serializerService
     * @param CommentServiceInterface $commentService
     */
    public function __construct(RequestServiceInterface $requestService, SerializerServiceInterface $serializerService, CommentServiceInterface $commentService)
    {
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
        $this->commentService = $commentService;
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
            'comments' => $comments
        ]);
    }
}
