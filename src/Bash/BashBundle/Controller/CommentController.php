<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace Bash\BashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bash\NodesBundle\Entity\Comment;
use Bash\NodesBundle\Form\CommentType;
use Bash\NodesBundle\Entity\Quote;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newAction($id)
    {
        $blog = $this->getBlogId($id);

        $comment = new Comment();
        $comment->setBlogId($blog);
        $form   = $this->createForm(new CommentType(), $comment);
//        $form = $this->createFormBuilder($comment)
//          //->add('subject', 'textarea')
//          ->add(
//            'comment',
//            'textarea',
//            array(
//              'attr' => array(
//                'class' => 'tinymce',
//                'data-theme' => 'bbcode' // Skip it if you want to use default theme
//              )
//            )
//          )
//          //->add('photos', 'file', array('data_class' => null, 'required' => false))
//          ->getForm();

        return $this->render('BashBashBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
          ));
    }

    public function createAction($id)
    {
        $quote = $this->getBlogId($id);
//
        $comment  = new Comment();
        $comment->setBlogId($quote);
        $request = $this->get('request_stack')->getCurrentRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->submit($request->request->get($form->getName()));
//
        if ($form->isValid()) {
            $usr= $this->get('security.context')->getToken()->getUser();
            $comment->setUser($usr->getUsername());
            $em = $this->getDoctrine()
              ->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('BashBashBundle_post', array(
                  'id' => $comment->getBlogId()->getId()))
            );
        }
        $em = $this->getDoctrine()
          ->getManager();
        $rate = $em->createQueryBuilder('q')
      ->select('q.rating')
      ->from('Bash\NodesBundle\Entity\Quote', 'q')
      ->where('q.id = :quote')
      ->setParameter('quote', $quote->getId())
      ->getQuery()
      ->getSingleScalarResult();

        $comments = $em->getRepository('Bash\NodesBundle\Entity\Comment', array('id' => $id))
          ->getCommentsForBlog($quote->getId());

        return $this->render('BashBashBundle:Page:post.html.twig', array(
            'id' => $comment->getBlogId()->getId(),
              'you_are' => $this->get('security.context')->getToken()->getUser(),
              'quote' => $quote,
               'rate' => $rate,
              'comment' => $comments,
          ));

    }

    protected function getBlogId($id)
    {
        $em = $this->getDoctrine()
          ->getManager();

        $quote = $em->getRepository('BashNodesBundle:Quote')->find($id);

        if (!$quote) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $quote;
    }

}