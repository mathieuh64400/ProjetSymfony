<?php

namespace App\Controller;

use App\Entity\Ecoscore;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class EcoscoreController extends AbstractController
{
     /**
     * @Route("/pnewscore", name="ecoscore_creation")
     * @IsGranted("ROLE_ADMIN")
     */
    public function creationarticle(Request $request){
        $score= new Ecoscore();
        $formulairebis=$this->createFormBuilder($score)
                    ->add('valeur')
                    // ->add('description')
                    ->getForm();

        $formulairebis->handleRequest($request);
        dump($score);
        if($formulairebis->isSubmitted() && $formulairebis-> isValid())
        {
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($score);
            $manager->flush();

            return $this->redirectToRoute('article_creation');
        }

        return $this->render('ecoscore/creation.html.twig', [
            'formscore' => $formulairebis->createView(),
        ]);
    
    }
}
