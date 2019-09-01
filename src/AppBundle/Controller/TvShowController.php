<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TvSeason;
use AppBundle\Services\Comment\CommentServiceInterface;
use AppBundle\Services\Paginator\PaginatorServiceInterface;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TvShowController extends Controller
{

    /**
     * @var RequestServiceInterface
     */
    private $requestService;

    /**
     * @var SerializerServiceInterface
     */
    private $serializer;

    /**
     * @var PaginatorServiceInterface
     */
    private $paginator;

    /**
     * @var CommentServiceInterface
     */
    private $commentService;

    /**
     * TvShowController constructor.
     * @param RequestServiceInterface $requestService
     * @param SerializerServiceInterface $serializer
     * @param PaginatorServiceInterface $paginator
     * @param CommentServiceInterface $commentService
     */
    public function __construct(RequestServiceInterface $requestService, SerializerServiceInterface $serializer, PaginatorServiceInterface $paginator, CommentServiceInterface $commentService)
    {
        $this->requestService = $requestService;
        $this->serializer = $serializer;
        $this->paginator = $paginator;
        $this->commentService = $commentService;
    }

    /**
     * @Route("/tv/view/{id}", name="view_tv_show", methods={"GET"})
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function view(Request $request, $id)
    {
        $getShow = $this->requestService->getByTvShowId($id, $this->container);

        $deserializedShow = $this->serializer->deserialize($getShow, 'TvShow');
        $createdBy = $this->serializer->deserializeData($deserializedShow->getCreatedBy(), 'Actor');


        $seasons = $this->paginator->paginate(
            $this->getSeasons($deserializedShow),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );


        $comments = $this->commentService->getAllById($id);

        return $this->render('tv/view.html.twig', [
            'show' => $deserializedShow,
            'seasons' => $seasons,
            'directors' => $createdBy,
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/tv/{tv_id}/view/season/{season_number}", name="view_season_info", methods={"GET"})
     *
     * @param TvSeason $season
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewSeason(Request $request, int $tv_id, int $season_number)
    {
        $episodes = json_decode($this->requestService->getShowEpisodes($tv_id, $season_number, $this->container), true)['episodes'];

        $deserializedEpisodes = $this->serializer->deserializeData($episodes, 'Episode');

        $pagedEpisodes = $this->paginator->paginate(
            $deserializedEpisodes,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)
        );

        return $this->render('tv/view_season_info.html.twig', [
            'episodes' => $pagedEpisodes
        ]);
    }

    public function getSeasons($show)
    {
        return $this->serializer->deserializeData($show->getSeasons(), 'TvSeason');
    }
}
