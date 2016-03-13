<?php

namespace MSTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MSTBundle:Default:index.html.twig');
    }
}
