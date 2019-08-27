<?php


namespace AppBundle\Services\Request;


use Symfony\Component\HttpFoundation\Request;

interface RequestServiceInterface
{
    public function getByQuery(?string $query, $container): ?string;
    public function getImageUrl(?string $imageUrl);
    public function getTrendingMoviesByDay($container);
    public function getByMovieId(int $id, $container);
    public function getByFilters(string $orderBy, string $genre, string $releaseYear, string $language, $container);
    public function getGenres($container);
    public function getLanguages($container);
    public function getImdbUrl($imdbId);
}