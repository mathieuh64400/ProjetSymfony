<?php

namespace App\Controller;

use App\Entity\Calendare;
use DateTime;
// use App\Repository\CalendareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
     /**
     * @Route("/api/{id}/edit", name="api_event_edit",methods={"PUT"})
     */
    public function majEvent(?Calendare $calendare,Request $request)
    {
        //recup données full calendar
        $donnees=json_decode($request->getContent());
        if (
            isset($donnees->title)&& !empty($donnees->title) &&
            isset($donnees->start)&& !empty($donnees->start)&&
            isset($donnees->end)&& !empty($donnees->end)&&
            isset($donnees->description)&& !empty($donnees->description)&&
            isset($donnees->backgroundColor)&& !empty($donnees->backgroundColor)
            ) {
                //compléte
                $code=200;
                if (!$calendare) {
                    !$calendare= new Calendare;
                    $code=201;
                }
                $calendare->setTitle($donnees->title);
                $calendare->setStart(new DateTime($donnees->start));
                if ($donnees->allDay) {
                    $calendare->setEnd(new DateTime($donnees->start)); 
                }else{
                    $calendare->setEnd(new DateTime($donnees->end)); 
                }
                $calendare->setAllDay($donnees->allDay);
                $calendare->setDescription($donnees->description);
                $calendare->setBackgroundColor($donnees->backgroundColor);
                $em= $this->getDoctrine()->getManager();
                $em->persist($calendare);
                $em->flush();
                return new Response('success',$code);

            }{//incompléte
                return new Response('Données icompletes',404);
            }
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
