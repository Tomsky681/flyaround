<?php

namespace WCSCoavBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="wcs_coav_homepage")
     */
    public function indexAction()
    {
        return $this->render('WCSCoavBundle:Default:index.html.twig');
    }
}
