<?php


namespace AppBundle\Services\Paginator;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaginatorService extends Controller implements PaginatorServiceInterface
{

    private $paginator;

    public function __construct()
    {
        $this->paginator = $this->get('knp_paginator');
    }

    public function paginate($target, int $page = 1, int $limit = 10)
    {
        return $this->paginator->paginate(
            $target,
            $page,
            $limit
        );
    }
}