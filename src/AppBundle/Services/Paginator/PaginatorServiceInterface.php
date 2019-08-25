<?php


namespace AppBundle\Services\Paginator;


interface PaginatorServiceInterface
{
    public function paginate($target, int $page = 1, int $limit = 10);
}