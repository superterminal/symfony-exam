<?php


namespace AppBundle\Services\Watched;

use AppBundle\Entity\Watched;
use AppBundle\Repository\WatchedRepository;
use AppBundle\Services\Users\UserServiceInterface;

class WatchedService implements WatchedServiceInterface
{
    /**
     * @var WatchedRepository
     */
    private $watchedRepository;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * WatchedService constructor.
     * @param WatchedRepository $watchedRepository
     * @param UserServiceInterface $userService
     */
    public function __construct(WatchedRepository $watchedRepository, UserServiceInterface $userService)
    {
        $this->watchedRepository = $watchedRepository;
        $this->userService = $userService;
    }

    /**
     * @param Watched $watched
     * @param int $id
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function insert(Watched $watched, int $id)
    {
        $watched
            ->setMovieId($id)
            ->setAuthor($this->userService->currentUser());

        return $this->watchedRepository->insert($watched);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function inList(int $id): bool
    {

        if (0 === count($this->watchedRepository->findBy(['movieId' => $id])))
        {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getAllMoviesByUser()
    {
        return $this
            ->watchedRepository
            ->findBy(['author' => $this->userService->currentUser()]);
    }

}