<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class SitemapController extends AbstractController
{
      /**
     * @Route("/sitemap.xml", name="sitemap",defaults={"_format"="xml"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(Request $request)
    // récuperer nom de l'hote depuis url
    {
        $hostname= $request->getSchemeAndHttpHost();
        // dd($hostname);
        $urls=[];
        // url statique
        $urls[]=['loc'=>$this->generateUrl('nous')];
        $urls[]=['loc'=>$this->generateUrl('contact')];
        $urls[]=['loc'=>$this->generateUrl('compte')];
        $urls[]=['loc'=>$this->generateUrl('profil')];
        $urls[]=['loc'=>$this->generateUrl('app_register')];
        $urls[]=['loc'=>$this->generateUrl('app_login')];
        $urls[]=['loc'=>$this->generateUrl('paiements')];
        $urls[]=['loc'=>$this->generateUrl('adresse_new')];
        //site dynamique
        foreach($this->getDoctrine()->getRepository(Article::class)->findAll() as $article){
            $image=[
            'loc' =>  $article->getImage(),
            ];
            $urls[]=[
                'loc'=> $this->generateUrl('paccueil',[
                    'id'=> $article->getId()
                ]),
                'image'=>$image
            ];
        }
        // dd($urls);
        //fabriquer reponse
        $response = new Response($this->renderView('sitemap/index.html.twig', [
            'urls' => $urls,
            'hostname'=>$hostname
        ]),200
    );
        //ajout en tête
        $response->headers->set('content-Type','text/xml');
        return $response;
    }
}
