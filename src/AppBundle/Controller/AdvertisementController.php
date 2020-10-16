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


class AdvertisementController extends Controller
{
    

   

    
    /**
     * @Route("/adv", name="add", methods="POST")
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
        $adv->setDescription($data->description);
        $adv->setPrice($data->price);

        $attachments = [];
        for ($i=0; $i<count($data->links); $i++)
        {
            $att = new Attachment();
            $att->setAdvertisement($adv);
            $att->setLink(trim($data->links[$i]));
            $attachments[$i] = $att;
        }

        $entityManager = $this->getDoctrine()->getManager();

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
     * @Route("/adv/{id}", name="get", methods="GET")
     */

    public function getAdvt($id)
    {
        //$data = json_decode($request->getContent());

        $adv = $this->getDoctrine()->getRepository(Advertisement::class)->find($id);
        if (!$adv) {
            
            return new Response('No advertisement found for id '.$data->id,404);
        }
      
        return new Response($adv->toJson());
    }

    /**
     * @Route("/adv", name="getAll",  methods="GET")
     */

    public function getAll(Request $request)
    {
        
        if ($request->query->has('start'))
            $from=$request->query->get('start');
        
        
        
        $adv = $this->getDoctrine()->getRepository(Advertisement::class)->findAll();
        if (!$adv) {          
            return new Response('No advertisements found',404);
        }

        $resp=[];
        if ($request->query->has('start'))
        {
            $j=0;
            for ($i=$from; $i<($from+10) && isset($adv[$i]); $i++)
            {
                $resp[$j]=$adv[$i]->toJson();
                $j++;
            }
            return new Response(json_encode($resp));
        }
        else 
        {
            for ($i=0; $i<count($adv); $i++)
            {
                $resp[$i]=$adv[$i]->toJson();
               
            }
            return new Response(json_encode($resp));
        }
        
    }


    
}


