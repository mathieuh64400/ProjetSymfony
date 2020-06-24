<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Validation;
use App\Entity\PaieCommande;
use App\Form\PaiementcbType;
use App\Service\EncryptService;
use App\Repository\PaieCommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PaieCommandeController extends AbstractController
{
    
    /**
     * @Route("/paie_commande", name="listecommande")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(PaieCommandeRepository $commande)
    {      
        return $this->render('paie_commande/index.html.twig', [
            'listecommande' => $commande->findAll()]);
        
    }
    /**
 * @Route("/paiement_commande/modifier/{id}", name="verifcommande")
 * @IsGranted("ROLE_ADMIN")
 */
public function editContact(PaieCommande $commande, Request $request)
{
    $form = $this->createForm(PaiementcbType::class, $commande);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($commande);
        $entityManager->flush();

        $this->addFlash('message', 'Status de la commande modifié avec succès');
        return $this->redirectToRoute('listecommande');
    }
    
    return $this->render('paie_commande/verifcommande.html.twig', [
        'listecommande' => $form->createView(),
    ]);
}
     /**
     * @Route("/choixmode_paie", name="choix_mode")
     * @IsGranted("ROLE_USER")
     */
    public function modepaie()
    {
        return $this->render('paie_commande/modepaie.html.twig', [
            'controller_name' => 'RhumaController',
        ]);
    }
    
     /**
     * @Route("/virement", name="virement")
     * @IsGranted("ROLE_USER")
     */
    public function virement(Request $request)
    {$virement= new Validation();
        $formulairebis=$this->createFormBuilder($virement)
                    ->add('validation',ChoiceType::class,array(
                        'choices'=> array(
                        'oui' =>1,
                        'Non' =>0,
                            ),
                            'expanded' =>true,
                            'multiple' => false ))
                    ->add('Nom')
                    
                    ->getForm();

        $formulairebis->handleRequest($request);
        dump($virement);
        if($formulairebis->isSubmitted() && $formulairebis-> isValid())
        {
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($virement);
            $manager->flush();
            
            return $this->redirectToRoute('paccueil');
           
        }

        return $this->render('paie_commande/virement.html.twig', [
            'controller_name' => 'RhumaController',
            'formpaievirement'=> $formulairebis->createView(),
        ]);
    }
    /**
     * @Route("/paiement_commande", name="commande_payer")
     * @IsGranted("ROLE_USER")
     */
    public function formcommande(Request $request)
     { //Génération d'une nouvelle clé     EncryptService $encryptService
        // $encryptkey = $encryptService->generateNewEncryptKey();
        // dd($encryptkey);
        // $ciphertext =  $encryptService->encrypt('Ceci est un texte strictement confidentiel.');
        // $decrypted =  $encryptService->decrypt($ciphertext);    
// Affichage pour contrôle
        // dd( ["Message chiffré" => $ciphertext, "Message déchiffré" => $decrypted]);
        $infocom= new PaieCommande();
        $formulairetrois=$this->createFormBuilder($infocom)
                        ->add('mode',ChoiceType::class,array(
                                     'choices'=> array(
                                        'MasterCard' =>1,
                                        'Visa' =>0,
                                     ),
                                     'expanded' =>true,
                                     'multiple' => false ))
                        ->add('adresse',ChoiceType::class,array(
                                    'choices'=> array(
                                    'principal' =>1,
                                    'secondaire' =>0,
                                        ),
                                        'expanded' =>true,
                                        'multiple' => false ))
                        ->add('civilite',EntityType::class,[
                                    'class'=>User::class,
                            'choice_label'=>'civilite'
                                        ])
                        ->add('Nom')
                        ->add('numeroCB')
                        ->add('dateExpiration',DateType::class,[
                               'widget' => 'choice',
                            ])
                        ->add('date',DateType::class,[
                            'widget' => 'choice', 
                        ])
                        ->add('etat')
                        ->add('cryptogramme')
                        ->getForm();
        $formulairetrois->handleRequest($request);
        if($formulairetrois->isSubmitted() && $formulairetrois-> isValid()){
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($infocom);
            $manager->flush();
            
            $this->addFlash('success',
           "votre paiement a été bien enregistré et sera débité quand votre commande sera arrivée à destination!!Precisez la date de paiement"
            ); 
            // $this = $translator->trans('Your comment is pending approval');
            return $this->redirectToRoute('paccueil');
        }
        return $this->render('paie_commande/paiementcommande.html.twig', [
                    'formpaiecommande' => $formulairetrois->createView(),
                ]);
        }
}
