<?php

namespace APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use APIBundle\Entity\User;

class InscriptionController extends Controller
{
    public function firstAction(Request $request) {
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('APIBundle:User');
        $em = $this->getDoctrine()->getManager();
        try {
            $login = $request->request->get('login');
            $password = $request->request->get('password');
            $user = $repository->findOneBy(array('username' => $login));
            if($user) {
                return new JsonResponse(array('success' => 0));
            }
            $user = new User();
            $user->setUsername($login);
            $user->setPassword($password);
            $user->setRandnum('');
            $em->persist($user);
            $em->flush();
            return new JsonResponse(array('success' => 1));
        }
        catch(Exception $e) {
            return new JsonResponse(array('success' => 0));
        }
    }
    
    public function signoutAction(Request $request) {
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('APIBundle:User');
        $em = $this->getDoctrine()->getManager();
        try {
            $login = $request->request->get('login');
            $conId = $request->request->get('conId');
            $user = $repository->findOneBy(array('username' => $login));
            if($user) {
                $user->removeToken($user->getToken(conId));
                return new JsonResponse(array('success' => 1));
            }
            return new JsonResponse(array('success' => 0));
        }
        catch(Exception $e) {
            return new JsonResponse(array('success' => 0));
        }
    }
}
