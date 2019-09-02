<?php


namespace AppBundle\Services\Request;

use Circle\RestClientBundle\Services\RestClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;


class RequestService extends Controller implements RequestServiceInterface
{
    const BASE_URL = 'https://api.themoviedb.org/3/search/';

    const TRENDING_BASE_URL = 'https://api.themoviedb.org/3/trending/movie/day';

    const GET_BY_ID_BASE_URL = 'https://api.themoviedb.org/3/movie/';

    const GET_BY_TVID_BASE_URL = 'https://api.themoviedb.org/3/tv/';

    const DISCOVER_BASE_URL = 'https://api.themoviedb.org/3/discover/movie';

    const GENRE_BASE_URL = 'https://api.themoviedb.org/3/genre/movie/list';

    const LANGUAGES_BASE_URL = 'https://api.themoviedb.org/3/configuration/languages';

    const BASE_IMAGE_URL = 'https://image.tmdb.org/t/p/w500';

    const BASE_PERSON_URL = 'https://api.themoviedb.org/3/person/';

    const IMDB_BASE_URL = 'https://www.imdb.com/title/';

    const IMDB_ACTOR_BASE_URL = 'https://www.imdb.com/name/';

    const NO_PHOTO_URL = 'https://stjohnscountybar.com/wp-content/uploads/2019/04/download.png';

    const YOUTUBE_BASE_URL = 'https://www.youtube.com/watch?v=';

    const POPULAR_TV_BASE_URL = 'https://api.themoviedb.org/3/tv/popular';

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

        $url = self::BASE_URL . "movie/?api_key=" . self::API_KEY .
            "&query=$query";

        return $restClient->get($url)->getContent();
    }

    /**
     * @param string $imageUrl
     * @return string
     */
    public function getImageUrl(?string $imageUrl)
    {
        if (null === $imageUrl) {
            return self::NO_PHOTO_URL;
        }

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

        return $restClient->get($url)->getContent();
    }

    public function getByTvShowId(int $id, $container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::GET_BY_TVID_BASE_URL . $id . '?api_key=' . self::API_KEY;

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
     * @param int $id
     * @param $container
     * @return false|string
     */
    public function getMovieCredits(int $id, $container)
    {
        /** @var RestClient $restClient */
        $restClient = $container->get('circle.restclient');

        $url = self::GET_BY_ID_BASE_URL . "$id/credits?api_key=" . self::API_KEY;

        return $restClient->get($url)->getContent();
    }

    public function getMovieActors(array $actors, $container)
    {
        /** @var RestClient $restClient */
        $restClient = $container->get('circle.restclient');
        $actorsStorage = [];

        foreach ($actors as $actor) {
            $url = self::BASE_PERSON_URL . $actor['id'] . '?api_key=' . self::API_KEY;
            $actorsStorage[] = $restClient->get($url)->getContent();
        }

        return $actorsStorage;
    }

    public function getActor(int $id, $container)
    {
        /** @var RestClient $restClient */
        $restClient = $container->get('circle.restclient');

        $url = self::BASE_PERSON_URL . "$id?api_key=" . self::API_KEY;

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

    /**
     * @param $imdbId
     * @return string
     */
    public function getImdbActor($imdbId)
    {
        return self::IMDB_ACTOR_BASE_URL . "$imdbId/";
    }


    public function getVideoData($id, $container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::GET_BY_ID_BASE_URL . $id . "/videos?api_key=" . self::API_KEY;

        return $restClient->get($url)->getContent();
    }

    public function getVideoUrl(string $key)
    {
        return self::YOUTUBE_BASE_URL . $key;
    }

    public function getPopularTvShows($container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::POPULAR_TV_BASE_URL . '?api_key=' . self::API_KEY;

        return $restClient->get($url)->getContent();
    }

    public function getShowEpisodes(int $tv_id, int $season_number, $container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::GET_BY_TVID_BASE_URL . $tv_id . '/season/' . $season_number . '?api_key=' . self::API_KEY;

        return $restClient->get($url)->getContent();
    }

    public function getMoviesForHomepage($container)
    {
        $restClient = $container->get('circle.restclient');

        $url = self::DISCOVER_BASE_URL . '?api_key=' . self::API_KEY;

        return $restClient->get($url)->getContent();
    }
}