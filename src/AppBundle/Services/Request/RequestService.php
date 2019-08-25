<?php


namespace AppBundle\Services\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;


class RequestService extends Controller implements RequestServiceInterface
{
    const BASE_URL = 'https://api.themoviedb.org/3/search/movie';

    const TRENDING_BASE_URL = 'https://api.themoviedb.org/3/trending/movie/day';

    const GET_BY_ID_BASE_URL = 'https://api.themoviedb.org/3/movie/';

    const BASE_IMAGE_URL = 'https://image.tmdb.org/t/p/w500';

    const API_KEY = '09d9101382d79a2be4f6c5081fb53919';


    /**
     * @param string|null $query
     * @param $container
     * @return string|null
     * @throws \Exception
     */
    public function getByQuery(?string $query, $container): ?string
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

    public function getTrendingMoviesByDay($container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::TRENDING_BASE_URL . "?api_key=" . self::API_KEY;

        return $restClient->get($url)->getContent();
    }

    public function getByMovieId(int $id, $container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::GET_BY_ID_BASE_URL . $id . "?api_key=" . self::API_KEY;

        return $restClient->get($url)->getContent();
    }
}