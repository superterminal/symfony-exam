<?php


namespace AppBundle\Services\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;


class RequestService extends Controller implements RequestServiceInterface
{
    const BASE_URL = 'https://api.themoviedb.org/3/search/movie';

    const BASE_IMAGE_URL = 'https://image.tmdb.org/t/p/w500';

    const API_KEY = '09d9101382d79a2be4f6c5081fb53919';

    public function getByQuery(string $query, $container): string
    {
        /** @var Container $restClient */
        $restClient = $container->get('circle.restclient');

        $url = self::BASE_URL . "?api_key=" . self::API_KEY .
            "&query=$query";

        return $restClient->get($url)->getContent();
    }


    public function getImageUrl(string $imageUrl)
    {
        $url = self::BASE_IMAGE_URL . $imageUrl;

        return $url;
    }
}