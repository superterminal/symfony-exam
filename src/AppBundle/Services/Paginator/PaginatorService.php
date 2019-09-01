<?php


namespace AppBundle\Services\Paginator;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaginatorService extends Controller implements PaginatorServiceInterface
{

    private $paginator;

    /**
     * PaginatorService constructor.
     * @param $paginator
     */
    public function __construct($paginator)
    {
        $this->paginator = $paginator;
    }


    /**
     * @param $target
     * @param int $page
     * @param int $limit
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function paginate($target, int $page = 1, int $limit = 10)
    {
        return $this->paginator->paginate(
            $target,
            $page,
            $limit
        );
    }
}