<?php


namespace AppBundle\Services\Request;


use Symfony\Component\HttpFoundation\Request;

interface RequestServiceInterface
{
    public function getByQuery(?string $query, $container): ?string;
    public function getImageUrl(?string $imageUrl);
    public function getTrendingMoviesByDay($container);
    public function getByMovieId(int $id, $container);
    public function getByTvShowId(int $id, $container);
    public function getByFilters(string $orderBy, string $genre, string $releaseYear, string $language, $container);
    public function getGenres($container);
    public function getMovieCredits(int $id, $container);
    public function getMovieActors(array $actors, $container);
    public function getActor(int $id, $container);
    public function getLanguages($container);
    public function getImdbUrl($imdbId);
    public function getImdbActor($imdbId);
    public function getVideoData($id, $container);
    public function getVideoUrl(string $key);
    public function getPopularTvShows($container);
    public function getShowEpisodes(int $tv_id, int $season_number, $container);
}