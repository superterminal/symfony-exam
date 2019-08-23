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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerProcess(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if (null !== $this->userService->findOneByUsername($form['username']->getData())) {
            $username = $this->userService->findOneByUsername($form['username']->getData())->getUsername();
            $this->addFlash('errors', "Username $username is already taken!");
            return $this->registerRender($user);
        }

        if ($form['password']['first']->getData() !== $form['password']['second']->getData()) {
            $this->addFlash("errors", "Passwords mismatch!");
            return $this->registerRender($user);
        }

        $this->userService->save($user);
        return $this->redirectToRoute('security_login');
    }

    /**
     * @Route("/logout", name="security_logout")
     *
     * @throws \Exception
     */
    public function logout()
    {
        throw new \Exception('logout failed');
    }

    /**
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerRender(User $user): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('users/register.html.twig', [
            'user' => $user,
            'form' => $this->createForm(UserType::class)->createView()
        ]);
    }
}
