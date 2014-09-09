<?php

namespace Bash\BashBundle\Extension;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bash\NodesBundle\Entity\Quote;
use Bash\NodesBundle\Entity\Comment;
use Bash\NodesBundle\Entity\Govnokod;
use Bash\BashBundle\Form\AddForm;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

class MyTwigExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
          'var_dump'   => new \Twig_Filter_Function('var_dump'),
          'coment_num'  => new \Twig_Filter_Method($this, 'coment_num'),
        );
    }

    public function coment_num($blog_id) {
        $em = $this->getDoctrine()->getManager();
        $count = $em->getRepository('Bash\NodesBundle\Entity\Comment')
          ->getCommentsCount($blog_id->getId());

        return $count;
    }

    public function getName()
    {
        return 'my_twig_extension';
    }

}