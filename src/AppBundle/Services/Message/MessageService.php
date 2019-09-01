<?php


namespace AppBundle\Services\Message;


use AppBundle\Entity\Message;
use AppBundle\Repository\MessageRepository;
use AppBundle\Services\Users\UserServiceInterface;

class MessageService implements MessageServiceInterface
{

    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * MessageService constructor.
     * @param MessageRepository $messageRepository
     * @param UserServiceInterface $userService
     */
    public function __construct(MessageRepository $messageRepository, UserServiceInterface $userService)
    {
        $this->messageRepository = $messageRepository;
        $this->userService = $userService;
    }

    /**
     * @param Message $message
     * @param int $recipientId
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Message $message, int $recipientId): bool
    {
        $sender = $this->userService->currentUser();
        $recipient = $this->userService->findOneById($recipientId);

        $message
            ->setSender($sender)
            ->setRecipient($recipient);

        return $this->messageRepository->insert($message);
    }

    /**
     * @return array
     */
    public function getAllByUser()
    {
        return $this->messageRepository
            ->findBy([
                'recipient' => $this->userService->currentUser()
            ],[
                'dateAdded' => 'DESC'
            ]);
    }

    /**
     * @param int $id
     * @return Message|null|object
     */
    public function getOne(int $id): ?Message
    {
        return $this->messageRepository->find($id);
    }

    public function getAllUnseenByUser()
    {
        return $this->messageRepository->findBy([
            'recipient' => $this->userService->currentUser(),
            'isSeen' => false
        ]);
    }
}