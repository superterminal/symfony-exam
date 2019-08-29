<?php


namespace AppBundle\Services\Comment;


use AppBundle\Entity\Comment;
use AppBundle\Repository\CommentRepository;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use AppBundle\Services\Users\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentService extends Controller implements CommentServiceInterface
{

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var RequestServiceInterface
     */
    private $requestService;

    /**
     * @var SerializerServiceInterface
     */
    private $serializerService;

    /**
     * CommentService constructor.
     * @param UserServiceInterface $userService
     * @param CommentRepository $commentRepository
     * @param RequestServiceInterface $requestService
     * @param SerializerServiceInterface $serializerService
     */
    public function __construct(UserServiceInterface $userService, CommentRepository $commentRepository, RequestServiceInterface $requestService, SerializerServiceInterface $serializerService)
    {
        $this->userService = $userService;
        $this->commentRepository = $commentRepository;
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
    }


    public function create(Comment $comment, int $movieId): bool
    {
        $comment
            ->setAuthor($this->userService->currentUser())
            ->setMovieId($movieId);

        return $this->commentRepository->insert($comment);
    }

    public function getAllByMovieId(int $movieId)
    {
        return $this->commentRepository->findBy(['movie_id' => $movieId], ['dateAdded' => 'DESC']);
    }
}