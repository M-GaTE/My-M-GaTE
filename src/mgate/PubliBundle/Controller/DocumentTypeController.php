<?php

namespace mgate\PubliBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocumentTypeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('mgatePubliBundle:Default:index.html.twig', array('name' => $name));
    }
}
