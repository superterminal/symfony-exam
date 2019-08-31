<?php


namespace AppBundle\Controller;


use AppBundle\Services\Request\RequestServiceInterface;
use AppBundle\Services\Serializer\SerializerServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends Controller
{

    /**
     * @var RequestServiceInterface
     */
    private $requestService;

    /**
     * @var SerializerServiceInterface
     */
    private $serializerService;

    /**
     * ActorController constructor.
     * @param RequestServiceInterface $requestService
     * @param SerializerServiceInterface $serializerService
     */
    public function __construct(RequestServiceInterface $requestService, SerializerServiceInterface $serializerService)
    {
        $this->requestService = $requestService;
        $this->serializerService = $serializerService;
    }

    /**
     * @Route("/view/actor/{id}", name="view_actor")
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function view(int $id)
    {
        $actor = $this->requestService->getActor($id, $this->container);

        $deserializedActor = $this->serializerService->deserialize($actor, 'Actor');


        return $this->render('users/actor.html.twig', [
            'actor' => $deserializedActor
        ]);
    }
}