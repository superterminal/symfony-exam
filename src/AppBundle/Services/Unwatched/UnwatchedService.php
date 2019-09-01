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

    /**
     * @param Unwatched $unwatched
     * @param int $id
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insert(Unwatched $unwatched, int $id)
    {
        $unwatched
            ->setMovieId($id)
            ->setAuthor($this->userService->currentUser());


        return $this->unwatchedRepository->insert($unwatched);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function inList(int $id): bool
    {
        if (0 !== count($this->unwatchedRepository->findBy(['movieId' => $id])))
        {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getAllMoviesByUser()
    {
        return $this
            ->unwatchedRepository
            ->findBy(['author' => $this->userService->currentUser()]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function remove(int $id)
    {
        return $this
            ->unwatchedRepository
            ->remove($id);
    }
}