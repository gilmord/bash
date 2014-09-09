<?php
// src/Iphpsandbox/PhotoBundle/Controller/PhotoController.php
namespace Bash\NodesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bash\NodesBundle\Entity\Test;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
//    public function indexAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $photo = new Test();
//        $uploadForm = $this->createFormBuilder($photo)
//          ->add('subject')
//          ->add('author')
//
//          //Using standart field type
//          ->add ('photos','file')
//          ->getForm();
//
//
//        if ($request->isMethod('POST')) {
//            $uploadForm->bind($request);
//
//            if ($uploadForm->isValid()) {
//                $em->persist($photo);
//                $em->flush();
//
//            }
//        }
//
//        return $this->render('BashBashBundle:Photo:up.html.twig', array(
//            'form' => $uploadForm->createView(),
//
//          ));
//    }
//    public function testAction()
//    {
//        $em = $this->getDoctrine()
//          ->getManager();
//        $test = $em->createQueryBuilder()
//          ->select('b')
//          ->from('Bash\NodesBundle\Entity\Test', 'b')
//          ->addOrderBy('b.id', 'DESC')
//          ->getQuery()
//          ->getResult();
//        return $this->render('BashBashBundle:Photo:test.html.twig', array(
//            'tests' => $test,
//          ));
//    }
}