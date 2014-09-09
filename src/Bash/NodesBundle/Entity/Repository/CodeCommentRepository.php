<?php
// src/Blogger/BlogBundle/Entity/Repository/BlogRepository.php

namespace Bash\NodesBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 */
class CodeCommentRepository extends EntityRepository
{
    public function getCodeCommentsForBlog($blog_id)
    {
        $qb = $this->createQueryBuilder('c')
          ->select('c')
          ->where('c.blog_id = :quote')
          ->addOrderBy('c.created')
          ->setParameter('quote', $blog_id);

        return $qb->getQuery()
          ->getResult();
    }


}