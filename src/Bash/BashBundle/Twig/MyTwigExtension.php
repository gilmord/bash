<?php

namespace Bash\BashBundle\Twig;


class BashExtensionExample extends \Twig_Extension
{
public function getFilters()
{
return array(
new \Twig_SimpleFilter('number_of_comments', array($this, 'nocFilter')),
);
}

public function nocFilter($blog_id)
{
    $em = $this->getDoctrine()->getManager();
    $count = $em->getRepository('Bash\NodesBundle\Entity\Comment')
      ->getCommentsCount($blog_id->getId());

return $count;
}

public function getName()
{
return 'acme_extension';
}
}