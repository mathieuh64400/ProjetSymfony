<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class RhumaController extends AbstractController
{
    /**
     * @Route("/rhuma", name="rhuma")
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
        return $this->render('rhuma/index.html.twig', [
            'controller_name' => 'RhumaController',
        ]);
    }
     /**
     * @Route("/nous", name="nous")
     * @IsGranted("ROLE_USER")
     */
    public function nous()
    { 
        return $this->render('rhuma/nous.html.twig', [
            'controller_name' => 'RhumaController',
        ]);
    }
    
      /**
     * @Route("/connectionprofil", name="connectionprofil")
     * @IsGranted("ROLE_USER")
     */
    public function connecprofil()
    {
        return $this->render('rhuma/connexionprofil.html.twig', [
            'controller_name' => 'RhumaController',
        ]);
    }
    /**
     * @Route("/profil", name="profil")
     * @IsGranted("ROLE_USER")
     */
    public function profil()
    {
        return $this->render('rhuma/profil.html.twig', [
            'controller_name' => 'RhumaController',
        ]);
    }
    /**
     * @Route("/compte", name="compte")
     * 
     */
    public function compte(){
    
        return $this->render('rhuma/compte.html.twig', [
             'controller_name' => 'RhumaController',
        ]);
    }
     /**
     * @Route("/historiqueCommandes", name="historiqueCommandes")
     * @IsGranted("ROLE_USER")
     */
    public function histoCommande()
    {
        return $this->render('rhuma/historiquecommandes.html.twig', [
            'controller_name' => 'RhumaController',
        ]);
    }
    /**
     * @Route("/paiements", name="paiements")
     * @IsGranted("ROLE_USER")
     */
    public function histopayement()
    {
        return $this->render('rhuma/historiquepayements.html.twig', [
            'controller_name' => 'RhumaController',
        ]);
    }
}
