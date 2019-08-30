<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Services\Message\MessageServiceInterface;
use AppBundle\Services\Users\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var MessageServiceInterface
     */
    private $messageService;

    /**
     * UserController constructor.
     * @param UserServiceInterface $userService
     * @param MessageServiceInterface $messageService
     */
    public function __construct(UserServiceInterface $userService, MessageServiceInterface $messageService)
    {
        $this->userService = $userService;
        $this->messageService = $messageService;
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
     * @Route("/profile", name="user_profile")
     */
    public function profile()
    {
        return $this->render('users/profile.html.twig', [
            'user' => $this->userService->currentUser(),
            'msg' => $this->messageService->getAllUnseenByUser()
        ]);
    }

    /**
     * @Route("/profile/edit", name="edit_profile", methods={"GET"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit()
    {
       return $this->render('users/edit.html.twig', [
           'user' => $this->userService->currentUser(),
           'form' => $this->createForm(UserType::class)->createView()
       ]);
    }

    /**
     * @Route("/profile/edit", methods={"POST"})
     *
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editProcess(Request $request)
    {
        $currentUser = $this->userService->currentUser();
        $form = $this->createForm(UserType::class, $currentUser);

        if ($currentUser->getUsername() === $request->request->get('username')) {
            $form->remove('username');
        }

        $form->remove('password');

        $currentImageUrl = $currentUser->getImage();

        $form->handleRequest($request);

        $this->uploadFile($form, $currentUser, $currentImageUrl);


        $this->userService->update($currentUser);

        return $this->redirectToRoute('user_profile');
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

    /**
     * @param FormInterface $form
     * @param User|null $user
     * @param $currentImageUrl
     */
    public function uploadFile(FormInterface $form, ?User $user, $currentImageUrl)
    {
        /** @var UploadedFile $file */
        $file = $form->get('image')->getData();

        //TO ADD: SHOULD BE ABLE TO EDIT WITHOUT UPLOADING PICTURE

        if ($file) {
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                $this->getParameter('users_directory'),
                $fileName
            );

            $user->setImage($fileName);

            $fs = new Filesystem();
            $fs->remove($currentImageUrl);
            //unlink('web/uploads/images/users/' . $currentImageUrl);
        }
    }
}
