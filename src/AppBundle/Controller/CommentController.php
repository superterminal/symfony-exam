<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use AppBundle\Services\Comment\CommentServiceInterface;
use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use AppBundle\Services\Users\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends Controller
{

    /**
     * @var CommentServiceInterface
     */
    private $commentService;

    /**
     * @var RequestServiceInterface
     */
    private $requestService;

    /**
     * @var SerializerServiceInterface
     */
    private $serializerService;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * CommentController constructor.
     * @param CommentServiceInterface $commentService
     * @param RequestServiceInterface $requestService
     * @param SerializerServiceInterface $serializerService
     * @param UserServiceInterface $userService
     */
    public function __construct(CommentServiceInterface $commentService, RequestServiceInterface $requestService, SerializerServiceInterface $serializerService, UserServiceInterface $userService)
    {
        $this->commentService = $commentService;
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
        $this->userService = $userService;
    }

    /**
     * @Route("/comment/create/{id}", name="comment_create", methods={"POST"})
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     */
    public function create(Request $request, $id)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $this->addFlash('message', 'Comment created successfully!');

        $this->commentService->create($comment, $id);

        return $this->redirectToRoute("view_movie", [
            'id' => $id
        ]);
    }

    /**
     * @Route("/user/{id}/message", name="user_message", methods={"GET"})
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function addUserMessage($id)
    {
        return $this->render("users/message.html.twig", [
            'user' => $this->userService->findOneById($id)
        ]);
    }

}
