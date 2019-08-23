<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Services\Users\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/register", name="user_register", methods={"GET"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register()
    {
        return $this->render('users/register.html.twig', [
            'form' => $this->createForm(UserType::class)->createView()
        ]);
    }

    /**
     * @Route("/register", methods={"POST"})
     *
     * @param Request $request
     */
    public function registerProcess(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if (null !== $this->userService->findOneByUsername($form['username']->getData())) {
            $email = $this->userService->findOneByUsername($form['username']->getData());
            $this->addFlash('errors', "Email $email is already taken!");
            return $this->render('users/register.html.twig', [
                'user' => $user,
                'form' => $this->createForm(UserType::class)->createView()
            ]);
        }

        if ($form['password']['first']->getData() !== $form['password']['second']->getData()) {
            $this->addFlash("errors", "Passwords mismatch!");
            return $this->render('users/register.html.twig', [
                'user' => $user,
                'form' => $this->createForm(UserType::class)->createView()
            ]);
        }

        $this->userService->save($user);
        return $this->redirectToRoute('security_login');
    }
}
