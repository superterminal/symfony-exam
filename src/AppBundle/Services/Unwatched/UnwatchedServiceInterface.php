<?php


namespace AppBundle\Services\Unwatched;


use AppBundle\Entity\Unwatched;

interface UnwatchedServiceInterface
{
    public function insert(Unwatched $unwatched, int $id);
    public function inList(int $id);
    public function getAllMoviesByUser();
    public function remove(int $id);
}