<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Form\MessageType;
use AppBundle\Repository\MessageRepository;
use AppBundle\Services\Message\MessageServiceInterface;
use AppBundle\Services\Users\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends Controller
{

    /**
     * @var MessageServiceInterface
     */
    private $messageService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * MessageController constructor.
     * @param MessageServiceInterface $messageService
     * @param UserServiceInterface $userService
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageServiceInterface $messageService, UserServiceInterface $userService, MessageRepository $messageRepository)
    {
        $this->messageService = $messageService;
        $this->userService = $userService;
        $this->messageRepository = $messageRepository;
    }


    /**
     * @Route("/user/{id}/message/create", name="message_create",  methods={"POST"})
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function create(Request $request, $id)
    {
        $message = $this->messageForm($request);

        $this->messageService->create($message, $id);
        $this->addFlash('message', 'Message sent successfully!');

        return $this->redirectToRoute('user_message', ['id' => $id]);
    }

    /**
     * @Route("/user/mailbox", name="user_mailbox",  methods={"GET"})
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function getAllByUser()
    {
        return $this->render("users/mailbox.html.twig",
            [
                'messages' => $this->messageService->getAllByUser()
            ]);
    }

    /**
     * @Route("/user/mailbox/message/{id}", name="user_mailbox_message",  methods={"GET"})
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function view(int $id)
    {
        $message = $this->messageService->getOne($id);
        $message->setIsSeen(true);

        $this->messageRepository->insert($message);

        return $this->render("messages/view.html.twig", [
            'msg' => $this->messageService->getOne($id)
        ]);
    }


    /**
     * @Route("/user/mailbox/message/{id}", name="user_mailbox_sent_message",  methods={"POST"})
     *
     * @param Request $request
     * @param int $id
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function sentMessageToRecipient(Request $request, $id)
    {
        $message = $this->messageForm($request);
        $messageId = $request->get('msgId');

        $senderId = $id;
        $this->messageService->create($message, $senderId);
        $this->addFlash('message', 'Message sent successfully!');

        return $this->redirectToRoute('user_mailbox_message', [
            'id' => $messageId,
            'msg' => $this->messageService->getOne($messageId)
        ]);
    }

    /**
     * @param Request $request
     * @return Message
     */
    public function messageForm(Request $request): Message
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);
        return $message;
    }
}
