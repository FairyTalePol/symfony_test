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

    /**
     * @Route("/add", name="add")
     */


    public function addAdvt(Request $request)
    {

        
        
        $data = json_decode($request->getContent());

      
        if (strlen($data->description)>1000)
            $data->description = substr($data->description,0,1000);
       


        $data->links=explode(",",$data->links);

            
        for ($i=3; $i<count($data->links); $i++)
        {
            unset($data->links[$i]);
        }

        $adv = new Advertisement();
        $adv->setDescription($data->description);//$data->description);
        $adv->setPrice($data->price);

        $entityManager = $this->getDoctrine()->getManager();
        //$entityManager->persist($adv);

        $attachments = [];
        for ($i=0; $i<count($data->links); $i++)
        {
            $att = new Attachment();
            $att->setAdvertisement($adv);
            $att->setLink(trim($data->links[$i]));
            $attachments[$i] = $att;
        }

        for ($i=0; $i<count($data->links); $i++)
        {
            $entityManager->persist($attachments[$i]);
            try{
                $entityManager->flush();
            }
            catch (Exception $e) {
                return new Response('Exception thrown: ',  $e->getMessage(), "\n",500);
            }
            
        }
      
       

        return new Response(json_encode('Saved new adv with id '.$adv->getId()));
        
    }
    /**
     * @Route("/get", name="get")
     */

    public function getAdvt(Request $request)
    {
        
        $data = json_decode($request->getContent());
        
        
       
        $adv = $this->getDoctrine()->getRepository(Advertisement::class)->find($data->id);
       

        if (!$adv) {
            
            return new Response('No advertisement found for id '.$data->id,404);
        }

        $adv->links = "Hey mama";//$adv->getAttachments();
      
        return new Response($adv->toJson());
        
    }
    

    /**
     * @Route("/getAll", name="getAll")
     */

    public function getAll(Request $request)
    {
        
        $data = json_decode($request->getContent());
        $from = $data->from;
        
        $adv = $this->getDoctrine()->getRepository(Advertisement::class)->findAll();
        if (!$adv) {          
            return new Response('No advertisements found',404);
        }

        $resp = [];
        $j = 0;
        for ($i=$from; $i<$from+10 && isset($adv[$i]); $i++)
        {
            $resp[$j]=$adv[$i]->toJson();
            $j++;
        }
      
        return new Response(json_encode($resp));
        
    }


    
}


