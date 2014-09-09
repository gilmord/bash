<?php

namespace Bash\VoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BashVoteBundle:Default:index.html.twig', array('name' => $name));
    }
}
