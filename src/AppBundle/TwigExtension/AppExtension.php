<?php

namespace AppBundle\TwigExtension;

use AppBundle\Services\Request\RequestServiceInterface;
use Twig\Extension\AbstractExtension;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $requestService;

    private $container;

    public function __construct(RequestServiceInterface $requestService, Container $container)
    {
        $this->requestService = $requestService;
        $this->container = $container;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('loadImage', [$this, 'loadImage']),
        ];
    }

    public function loadImage(string $imageUrl)
    {
        return $this->requestService->getImageUrl($imageUrl);
    }
}