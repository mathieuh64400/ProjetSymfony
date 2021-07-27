<?php

namespace App\Controller;

use App\Repository\CalendareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController extends AbstractController
{
    /**
     * @Route("/calendrier", name="calendrier")
     */
    public function index(CalendareRepository $calendare)
    {
        $events = $calendare->findAll();
        // dd($events);
        foreach ($events as $event) {
            $rdvs[]=[
                'id' => $event->getId(),
                'title' => $event->getTitle(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'description' => $event->getDescription(),
                'all_day' => $event->getAllDay(),
                'background-color' => $event->getBackgroundColor()

            ];
        }
        $data=json_encode($rdvs);

        return $this->render('calendrier/index.html.twig', compact('data'));
    }
}
