<?php

namespace App\Controller;

use App\Entity\Nature;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class NatureController extends AbstractController
{
    /**
     * @Route("/pnewNatureEvent", name="natureEvent_creation")
     * @IsGranted("ROLE_ADMIN")
     */
    public function creationarticle(Request $request){
        $nature= new Nature();
        $formnature=$this->createFormBuilder($nature)
                    ->add('Type')
                    ->getForm();

        $formnature->handleRequest($request);
        dump($nature);
        if($formnature->isSubmitted() && $formnature-> isValid())
        {
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($nature);
            $manager->flush();

            return $this->redirectToRoute('nous');
        }

        return $this->render('nature/creation.html.twig', [
            'formnature' => $formnature->createView(),
        ]);
    
    }
}
