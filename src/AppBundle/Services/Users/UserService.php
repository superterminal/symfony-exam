<?php


namespace AppBundle\Services\Users;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;

class UserService implements UserServiceInterface
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $username
     * @return User|null|object
     */
    public function findOneByUsername(string $username): ?User
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }

    public function save(User $user): bool
    {
        
    }

    public function update(?User $user): bool
    {
        // TODO: Implement update() method.
    }

    public function findOneById(int $id): ?User
    {
        // TODO: Implement findOneById() method.
    }

    public function findOne(User $user): ?User
    {
        // TODO: Implement findOne() method.
    }

    public function currentUser(): ?User
    {
        // TODO: Implement currentUser() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }
}