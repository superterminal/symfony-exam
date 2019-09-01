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

    /**
     * @param Comment $comment
     * @param int $id
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(Comment $comment, int $id): bool
    {
        $comment
            ->setAuthor($this->userService->currentUser())
            ->setProductionId($id);

        return $this->commentRepository->insert($comment);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getAllById(int $id)
    {
        return $this->commentRepository->findBy(['production_id' => $id], ['dateAdded' => 'DESC']);
    }
}