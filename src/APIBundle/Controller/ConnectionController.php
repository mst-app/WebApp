<?php

namespace APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use APIBundle\Entity\User;

class ConnectionController extends Controller
{
    public function firstAction($login) {
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('APIBundle:User');
        
        $random = rand();
        $magicnumber = hash('sha256', $random);
        $user = $repository->findOneBy(array('username' => $login));   
        if($user != null)
        {
            $user->setRandnum($magicnumber);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return new JsonResponse(array('n' => $magicnumber));
        }
        return new JsonResponse(array('n' => null));
        
    }
    
    public function secondAction($login, Request $request) {
        $auth = $request->request->get('auth');
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('APIBundle:User');
        $em = $this->getDoctrine()->getManager();
        $user = $repository->findOneBy(array('username' => $login));
        if($user == null)
            return new JsonResponse(array('success' => 0, 'token' => 0));
        $pw = $user->getPassword();
        $phrase = (string)$login . ":" . $user->getRandnum() . ":" . $pw;
        $tmp = hash_hmac("sha256", $phrase, $pw);
        if ($auth == $tmp)
        {
            $user->setToken($auth);
            $conID = count($user->getToken) - 1;
            $em->persist($user);
            $em->flush();
            return new JsonResponse(array('success' => 1, 'token' => $auth));
        }
        return new JsonResponse(array('success' => $phrase, 'connectionId' => $conID, 'token' => 0));
    }
}
