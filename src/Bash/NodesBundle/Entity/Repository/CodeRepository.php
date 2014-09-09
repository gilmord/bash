<?php
// src/Blogger/BlogBundle/Entity/Repository/BlogRepository.php

namespace Bash\NodesBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BashRepository
 */
class CodeRepository extends EntityRepository
{
    public function getLatestCodes($limit = null)
    {
        $qb = $this->createQueryBuilder('b')
          ->select('b')
          ->addOrderBy('b.created', 'DESC');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
          ->getResult();
    }
}