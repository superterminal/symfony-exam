<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Video;
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


    public function __construct(RequestServiceInterface $requestService,
                                SerializerServiceInterface $serializerService)
    {
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
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

        /** @var Video $video */
        foreach ($videos as $video) {
            if ($video->getSite() === 'YouTube' && $video->getType() == 'Trailer') {
                $trailerKey = $video->getKey();
                break;
            }
        }

        return $this->render('movies/view.html.twig', [
            'movie' => $mappedMovie,
            'trailerKey' => $trailerKey
        ]);
    }
}
