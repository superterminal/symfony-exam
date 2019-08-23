<?php


namespace AppBundle\Services\Users;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use AppBundle\Services\Encryption\EncryptionServiceInterface;
use Symfony\Component\Security\Core\Security;

class UserService implements UserServiceInterface
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    /**
     * @var Security
     */
    private $security;

    public function __construct(UserRepository $userRepository,
                                EncryptionServiceInterface $encryptionService,
                                Security $security)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
        $this->security = $security;
    }

    /**
     * @param string $username
     * @return User|null|object
     */
    public function findOneByUsername(string $username): ?User
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        $passwordHash = $this->encryptionService->hash($user->getPassword());
        $user->setPassword($passwordHash);

        //to add ROLES and default picture
        $user->setImage('');

        return $this->userRepository->insert($user);
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function update(?User $user): bool
    {
        return $this->userRepository->update($user);
    }

    /**
     * @param int $id
     * @return User|null|object
     */
    public function findOneById(int $id): ?User
    {
        return $this->userRepository->findOneBy(['id' => $id]);
    }

    /**
     * @param User $user
     * @return User|null|object
     */
    public function findOne(User $user): ?User
    {
        return $this->userRepository->find($user);
    }

    /**
     * @return User|null|object
     */
    public function currentUser(): ?User
    {
        return $this->security->getUser();
    }

    public function getAll()
    {
        return $this->userRepository->findAll();
    }
}