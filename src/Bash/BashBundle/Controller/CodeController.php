<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace Bash\BashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bash\NodesBundle\Entity\Code;
use Bash\VoteBundle\Entity\CRate;
use Bash\NodesBundle\Form\CodeType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Comment controller.
 */
class CodeController extends Controller
{
    public function newAction()
    {
        $quote = new Code();
        $form   = $this->createForm(new CodeType(), $quote);

        return $this->render('BashBashBundle:Code:form.html.twig', array(
            'quote' => $quote,
            'form'   => $form->createView()
          ));
    }

    public function createAction(Request $request)
    {

//
        $quote = new Code();
        // $request = $this->get('request_stack')->getCurrentRequest();
        $form    = $this->createForm(new CodeType(), $quote);
        //$form->submit($request->request->get($form->getName()));



        $form->bind($request);
        if ($form->isValid()) {

            //$quote->upload();
            $usr= $this->get('security.context')->getToken()->getUser();
            //$quote->setType('quote');
            $quote->setAuthor($usr->getUsername());
            $quote->setRating(0);
            $em = $this->getDoctrine()
              ->getManager();
            $em->persist($quote);

            $em->flush();
            return $this->redirect($this->generateUrl('BashBashBundle_govnokod',  array(
                  'id' => 1
                )));
        }
        return $this->render('BashBashBundle:Page:addcode.html.twig', array(
            'form' => $form->createView()
          ));



    }

    public function editAction($id, Request $request)
    {
        $usr = $this->get('security.context')->getToken()->getUser();

        // $request = $this->get('request_stack')->getCurrentRequest();

        $em = $this->getDoctrine()->getManager();
        $quote = $em->getRepository('Bash\NodesBundle\Entity\Code')->find($id);
        if (!$quote) {
            throw $this->createNotFoundException(
              'No news found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($quote)
          //->add('subject', 'textarea')
          ->add(
            'subject',
            'textarea',
            array(
              'attr' => array(
                'class' => 'tinymce',
                'rows' => 15,
                'cols' => 15,
                'data-theme' => 'bbcode' // Skip it if you want to use default theme
              )
            )
          )
          ->add('imageFile', 'file', array('required' => false))
          ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect(
              $this->generateUrl(
                'BashBashBundle_codepost',
                array(
                  'id' => $quote->getId()
                )
              )
            );
        }

        //$build['form'] = $form->createView();

        return $this->render(
          'BashBashBundle:Code:edit.html.twig',
          array(
            'user' => $usr->getUsername(),
            'form' => $form->createView(),
            'quote' => $quote,
            'id' => $id,

          )
        );
    }

    public function dellAction($id, Request $request)
    {

        $usr = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $quote = $em->getRepository('Bash\NodesBundle\Entity\Code')->find($id);
        if (!$quote) {
            throw $this->createNotFoundException(
              'No news found for id ' . $id
            );
        }

        $form = $this->createFormBuilder($quote)
          ->add('delete', 'submit', array('attr' => array('class' => 'form-submit', 'id' => 'edit-submit')))
          ->getForm();

        $form->handleRequest($request);


        if ($form->isValid()) {
            $em->remove($quote);
            $em->flush();

            return $this->redirect(
              $this->generateUrl(
                'BashBashBundle_recent',
                array(
                  'id' => 1
                )
              )
            );
        }

        return $this->render(
          'BashBashBundle:Code:dell.html.twig',
          array(
            'id' => $id,
            'user' => $usr->getUsername(),
            'quote' => $quote,
            'form' => $form->createView(),
          )
        );
    }
}