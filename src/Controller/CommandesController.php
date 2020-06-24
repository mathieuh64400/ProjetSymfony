<?php

namespace App\Controller;

use App\Entity\Nature;
use App\Entity\ChoixCommande;
use App\Entity\NatureCommande;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandesController extends AbstractController
{
     /**
     * @Route("/commande", name="commande")
     * IsGranted("ROLE_ADMIN")
     */
    public function index()
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
    /**
     * @Route("/pnewtypecommande", name="typecommande_creation")
     * @IsGranted("ROLE_ADMIN")
     */
    public function creationtypecommande(Request $request){
        $typecommande= new NatureCommande();
        $formulairetypecommande=$this->createFormBuilder($typecommande)
                    ->add('Type')
                    // ->add('description')
                    ->getForm();

        $formulairetypecommande->handleRequest($request);
        dump($typecommande);
        if($formulairetypecommande->isSubmitted() && $formulairetypecommande-> isValid())
        {
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($typecommande);
            $manager->flush();

            return $this->redirectToRoute('paccueil');
        }

        return $this->render('commandes/creation.html.twig', [
            'formtypecommande' => $formulairetypecommande->createView(),
        ]);
    
    }
    /**
     * @Route("/choixommande", name="choix_Commande")
     * @IsGranted("ROLE_USER")
     */
    public function creationchoixtypecommande(Request $request){
        $choixtypecommande= new ChoixCommande();
        $formchoixtypecommande=$this->createFormBuilder($choixtypecommande)
                    
                    ->add('detail',TextareaType::class)
                    
                    ->add('natureCommande',EntityType::class,[
                        'class'=>NatureCommande::class,
                        'choice_label'=>'Type'
                    ])
                    ->add('nature',EntityType::class,[
                        'class'=>Nature::class,
                        'choice_label'=>'Type'
                    ])
                   
                    ->getForm();

        $formchoixtypecommande->handleRequest($request);
        dump($choixtypecommande);
        if($formchoixtypecommande->isSubmitted() && $formchoixtypecommande-> isValid())
        {
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($choixtypecommande);
            $manager->flush();

            return $this->redirectToRoute('choix_mode');
        }

        return $this->render('commandes/creat.html.twig', [
            'formchoixtypecommande' => $formchoixtypecommande->createView(),
        ]);
    
    }
}
