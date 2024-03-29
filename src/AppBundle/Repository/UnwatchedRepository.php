<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Unwatched;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;

/**
 * UnwatchedRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UnwatchedRepository extends \Doctrine\ORM\EntityRepository
{
    public function __construct(EntityManagerInterface $em,
                                Mapping\ClassMetadata $metaData = null)
    {
        parent::__construct($em,
            $metaData == null ?
                new Mapping\ClassMetadata(Unwatched::class) :
                $metaData);
    }

    /**
     * @param Unwatched $unwatched
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insert(Unwatched $unwatched)
    {
        try {
            $this->_em->persist($unwatched);
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }

    /**
     * @param int $movieId
     * @return mixed
     */
    public function remove(int $movieId)
    {
        $qb = $this->_em->createQueryBuilder()
            ->delete()
            ->from('AppBundle:Unwatched', 'u')
            ->where('u.movieId = ?1')
            ->setParameter(1, $movieId)
            ->getQuery();

        return $qb->getResult();
    }
}
