<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Advertisement;
use AppBundle\Entity\Attachment;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class DefaultController extends Controller
{
    

    /**
     * @Route("/", name="homepage")
    */

    public function onLoad()
    {
        return $this->render('default/new.html.twig');
    }

 

    
}


