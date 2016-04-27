<?php

namespace APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use APIBundle\Entity\User;
use APIBundle\Entity\Bus;
use APIBundle\Entity\Location;

class BusController extends Controller
{
    public function addStopAction($busline, Request $request) {
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('APIBundle:User');
        $em = $this->getDoctrine()->getManager();
        try {
            $login = $request->request->get('login');
            $num = $request->request->get('cn');
            $ciphertext = $request->request->get('data');
            $user = $repository->findOneBy(array('username' => $login));
            $token = $user->getToken($num);
            $data = mcrypt_decrypt('sha256', $token, $ciphertext);
            $array = explode(':', $data);
            $bus = searchOrAddBus($busline);
            $stop = addStop($array[0], $array[1], floatval($array[2]), floatval($array[3]));
            $bus->addStop($stop);
            $em->persist($bus);
            $em->flush();
        }
        catch (Exception $e) {
            
        }
    }
    
    private function searchOrAddBus($id)
    {
        $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('APIBundle:Bus');
        $em = $this->getDoctrine()->getManager();
        $bus = $repository->findOneBy(array('line' => $id));
        if (!bus) {
            $bus = new Bus();
            $bus->setLine($id);
            $em->persist($bus);
            $em->flush($bus);
        }
        return $bus;    
    }
    
    private function addStop($name, $city, $x, $y)
    {
        $em = $this->getDoctrine()->getManager();
        $stop = new Location();
        $stop->setName($name);
        $stop->setCity($city);
        $stop->setX($x);
        $stop->setY($y);
        $em->persist($stop);
        $em->flush();
        return $stop;
    }
}
