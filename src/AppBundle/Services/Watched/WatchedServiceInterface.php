<?php


namespace AppBundle\Services\Watched;


use AppBundle\Entity\Watched;

interface WatchedServiceInterface
{
    public function insert(Watched $watched, int $id);
    public function inList(int $id);
    public function getAllMoviesByUser();
}