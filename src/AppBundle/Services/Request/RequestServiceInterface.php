<?php


namespace AppBundle\Services\Request;


use Symfony\Component\HttpFoundation\Request;

interface RequestServiceInterface
{
    public function getByQuery(?string $query, $container): ?string;
    public function getImageUrl(string $imageUrl);
    public function getTrendingMoviesByDay($container);
}