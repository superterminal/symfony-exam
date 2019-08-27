<?php


namespace AppBundle\Services\Request;

use Circle\RestClientBundle\Services\RestClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;


class RequestService extends Controller implements RequestServiceInterface
{
    const BASE_URL = 'https://api.themoviedb.org/3/search/movie';

    const TRENDING_BASE_URL = 'https://api.themoviedb.org/3/trending/movie/day';

    const GET_BY_ID_BASE_URL = 'https://api.themoviedb.org/3/movie/';

    const DISCOVER_BASE_URL = 'https://api.themoviedb.org/3/discover/movie';

    const GENRE_BASE_URL = 'https://api.themoviedb.org/3/genre/movie/list';

    const LANGUAGES_BASE_URL = 'https://api.themoviedb.org/3/configuration/languages';

    const BASE_IMAGE_URL = 'https://image.tmdb.org/t/p/w500';

    const IMDB_BASE_URL = 'https://www.imdb.com/title/';

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

    /**
     * @param string $imageUrl
     * @return string
     */
    public function getImageUrl(string $imageUrl)
    {
        $url = self::BASE_IMAGE_URL . $imageUrl;

        return $url;
    }

    /**
     * @param $container
     * @return mixed
     */
    public function getTrendingMoviesByDay($container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::TRENDING_BASE_URL . "?api_key=" . self::API_KEY;

        return $restClient->get($url)->getContent();
    }

    /**
     * @param int $id
     * @param $container
     * @return mixed
     */
    public function getByMovieId(int $id, $container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::GET_BY_ID_BASE_URL . $id . "?api_key=" . self::API_KEY;

        var_dump($url);

        return $restClient->get($url)->getContent();
    }

    /**
     * @param string $orderBy
     * @param string $genre
     * @param string $releaseYear
     * @param string $language
     * @param $container
     * @return mixed
     */
    public function getByFilters($orderBy, $genre, $releaseYear, $language, $container)
    {
        $restClient = $container->get('circle.restclient');

        if ($genre == '\\') {
            $genre = '';
        }

        if ($releaseYear == '\\') {
            $releaseYear = '';
        }

        if ($language == '\\') {
            $language = '';
        }

        $url = self::DISCOVER_BASE_URL . "?api_key=" . self::API_KEY . "&sort_by=$orderBy&primary_release_year=$releaseYear&with_genres=$genre&with_original_language=$language";

        return $restClient->get($url)->getContent();
    }

    /**
     * @param $container
     * @return mixed
     */
    public function getGenres($container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::GENRE_BASE_URL . "?api_key=" . self::API_KEY;

        return $restClient->get($url)->getContent();
    }

    /**
     * @param $container
     * @return string
     */
    public function getLanguages($container)
    {
        /** @var RestClient $restClient */
        $restClient = $container->get('circle.restclient');

        $url = self::LANGUAGES_BASE_URL . "?api_key=" . self::API_KEY;

        return $restClient->get($url)->getContent();
    }

    /**
     * @param $imdbId
     * @return string
     */
    public function getImdbUrl($imdbId)
    {
        return self::IMDB_BASE_URL . "$imdbId/";
    }
}