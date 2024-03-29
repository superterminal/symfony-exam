<?php

namespace AppBundle\TwigExtension;

use AppBundle\Services\Request\RequestServiceInterface;
use http\Encoding\Stream\Inflate;
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
            new TwigFunction('imdbLink', [$this, 'imdbLinkBuilder']),
            new TwigFunction('imdbActor', [$this, 'imdbActorLinkBuilder']),
            new TwigFunction('youtubeLink', [$this, 'youtubeLinkBuilder']),
        ];
    }

    /**
     * @param string|null $imageUrl
     * @return mixed
     */
    public function loadImage(?string $imageUrl)
    {
        return $this->requestService->getImageUrl($imageUrl);
    }

    /**
     * @param string|null $imdbId
     * @return mixed
     */
    public function imdbLinkBuilder(?string $imdbId)
    {
       return $this->requestService->getImdbUrl($imdbId);
    }

    /**
     * @param string|null $imdb
     * @return mixed
     */
    public function imdbActorLinkBuilder(?string $imdb)
    {
        return $this->requestService->getImdbActor($imdb);
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function youtubeLinkBuilder(?string $key)
    {
        return $this->requestService->getVideoUrl($key);
    }
}