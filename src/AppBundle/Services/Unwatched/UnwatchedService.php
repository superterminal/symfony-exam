<?php


namespace AppBundle\Services\Unwatched;


use AppBundle\Entity\Unwatched;
use AppBundle\Repository\UnwatchedRepository;
use AppBundle\Services\Users\UserServiceInterface;

class UnwatchedService implements UnwatchedServiceInterface
{
    /**
     * @var UnwatchedRepository
     */
    private $unwatchedRepository;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * UnwatchedService constructor.
     * @param UnwatchedRepository $unwatchedRepository
     * @param UserServiceInterface $userService
     */
    public function __construct(UnwatchedRepository $unwatchedRepository, UserServiceInterface $userService)
    {
        $this->unwatchedRepository = $unwatchedRepository;
        $this->userService = $userService;
    }

    public function insert(Unwatched $unwatched, int $id)
    {
        $unwatched
            ->setMovieId($id)
            ->setAuthor($this->userService->currentUser());


        return $this->unwatchedRepository->insert($unwatched);
    }

    public function inList(int $id): bool
    {
        if (0 !== count($this->unwatchedRepository->findBy(['movieId' => $id])))
        {
            return true;
        }

        return false;
    }
}