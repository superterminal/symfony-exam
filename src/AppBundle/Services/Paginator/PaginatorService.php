<?php


namespace AppBundle\Services\Paginator;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaginatorService extends Controller implements PaginatorServiceInterface
{

    private $paginator;

    //dependency injection $paginator
    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
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