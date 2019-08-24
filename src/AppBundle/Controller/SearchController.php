<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Search;
use AppBundle\Form\SearchType;
use AppBundle\Services\Request\RequestServiceInterface;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SearchController extends Controller
{

    /**
     * @var RequestServiceInterface
     */
    private $requestService;

    public function __construct(RequestServiceInterface $requestService)
    {
        $this->requestService = $requestService;
    }

    /**
     * @Route("/search", name="search_action", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search()
    {
        return $this->render('browse/load.html.twig');
    }

    /**
     * @Route("/search", methods={"POST"})

     * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        $result = $this->requestService->getByQuery($search->getInput(), $this->container);
        //$resultJson = json_decode($result, true)['results'];
        $serializer = SerializerBuilder::create()->build();
        $object = $serializer->deserialize($result, 'AppBundle\Entity\Page', 'json');
        var_dump($object);
        exit;
    }
}
