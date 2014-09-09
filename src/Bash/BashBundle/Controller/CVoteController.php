<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace Bash\BashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bash\VoteBundle\Entity\CVote;
use Bash\VoteBundle\Entity\CRate;

/**
 * CVote controller.
 */
class CVoteController extends Controller
{
    public function voteAction($quote, $value, $from)
    {
        if( ($value !=1 ) and ($value != -1)) {
            throw $this->createNotFoundException(
              'Only 1 or -1'
            );
        }
        $em = $this->getDoctrine()
          ->getManager();

        $qt = $em->getRepository('Bash\NodesBundle\Entity\Code')->find($quote);

        if (!$qt) {
            throw $this->createNotFoundException('404');
        }

        $usr = $this->get('security.context')->getToken()->getUser();
        $user = $usr->getUsername();



        $qb = $em->createQueryBuilder('q')
          ->select('q.value')
          ->from('Bash\VoteBundle\Entity\CVote', 'q')
          ->where('q.voter = :user', 'q.quote = :quote')
          ->setParameter('user', $user)
          ->setParameter('quote', $quote)
          ->getQuery()
          ->getOneOrNullResult();


        if (!$qb) {

            $vote = new CVote;

            $usr = $this->get('security.context')->getToken()->getUser();
            $vote->setVoter($usr->getUsername());
            $vote->setValue($value);
            $vote->setQuote($quote);

            $em = $this->getDoctrine()
              ->getManager();

            $em->persist($vote);

            $rate = $em->createQueryBuilder('q')
              ->select('q')
              ->from('Bash\NodesBundle\Entity\Code', 'q')
              ->where('q.id = :id')
              ->setParameter('id', $quote)
              ->getQuery()
              ->getOneOrNullResult();

            $old = $rate->getRating();
            $rate->setRating($old + $value);
            $em->persist($rate);

            $em->flush();

            if ($from == 'recent') {
                return $this->redirect(
                  $this->generateUrl(
                    'BashBashBundle_govnokod',
                    array(
                      'id' => 1
                    )
                  )
                );
            }
            if ($from == 'post') {
                return $this->redirect(
                  $this->generateUrl(
                    'BashBashBundle_codepost',
                    array(
                      'id' => $quote
                    )
                  )
                );
            }
            if ($from == 'random') {
                return $this->redirect($this->generateUrl('BashBashBundle_random'));
            }
            if ($from == 'best') {
                return $this->redirect($this->generateUrl('BashBashBundle_best'));
            }
        }

        if ($qb == $value) {

            if ($from == 'recent') {
                return $this->redirect(
                  $this->generateUrl(
                    'BashBashBundle_govnokod',
                    array(
                      'id' => 1
                    )
                  )
                );
            }
            if ($from == 'post') {
                return $this->redirect(
                  $this->generateUrl(
                    'BashBashBundle_codepost',
                    array(
                      'id' => $quote
                    )
                  )
                );
            }
            if ($from == 'random') {
                return $this->redirect($this->generateUrl('BashBashBundle_random'));
            }
            if ($from == 'best') {
                return $this->redirect($this->generateUrl('BashBashBundle_best'));
            }
        }

        if ($qb != $value) {

            $em = $this->getDoctrine()->getManager();
            $dell = $em->createQueryBuilder('q')
              ->select('q')
              ->from('Bash\VoteBundle\Entity\CVote', 'q')
              ->where('q.voter = :user', 'q.quote = :quote')
              ->setParameter('user', $user)
              ->setParameter('quote', $quote)
              ->getQuery()
              ->getOneOrNullResult();
            $em->remove($dell);
            $em->flush();

            $vote = new CVote;

            $usr = $this->get('security.context')->getToken()->getUser();
            $vote->setVoter($usr->getUsername());
            $vote->setValue($value);
            $vote->setQuote($quote);

            $em = $this->getDoctrine()
              ->getManager();

            $em->persist($vote);

            $rate = $em->createQueryBuilder('q')
              ->select('q')
              ->from('Bash\NodesBundle\Entity\Code', 'q')
              ->where('q.id = :id')
              ->setParameter('id', $quote)
              ->getQuery()
              ->getOneOrNullResult();

            $old = $rate->getRating();
            $rate->setRating($old + 2*$value);


            $em->persist($rate);

            $em->flush();

            if ($from == 'recent') {
                return $this->redirect(
                  $this->generateUrl(
                    'BashBashBundle_govnokod',
                    array(
                      'id' => 1
                    )
                  )
                );
            }
            if ($from == 'post') {
                return $this->redirect(
                  $this->generateUrl(
                    'BashBashBundle_codepost',
                    array(
                      'id' => $quote
                    )
                  )
                );
            }
            if ($from == 'random') {
                return $this->redirect($this->generateUrl('BashBashBundle_random'));
            }
            if ($from == 'best') {
                return $this->redirect($this->generateUrl('BashBashBundle_best'));
            }

        }


    }


}
