<?php

namespace App\Controller;

use App\Entity\Total;

use App\Entity\Panier;
use App\Entity\Article;
use App\Entity\ListeArticle;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/updatePanier/{id}", name="updatePanier")
     * @IsGranted("ROLE_USER")
     */

    public function update($id, Request $request)
    {
        // Modifier la quantité d'un aticle dans le panier
        $qte = $request->get('qte');
        $manager = $this->getDoctrine()->getManager();
        $panier = $manager->getRepository(Panier::class)->find($id);
        if ($panier) {
            $panier->setQte($qte);
            $manager->flush();
        }
        $montant=$panier->getQte()*$panier->getaticle()->getPrix();
        // return $this->json(['message' => 'La quantité a été modifié','montant'=>$montant]);
        // return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/deletePanier/{id}", name="deletePanier")
     * @IsGranted("ROLE_USER")
     */

    public function delete($id, Request $request)
    {
        // Supprimer un aticle du panier
        $manager = $this->getDoctrine()->getManager();
        $panier = $manager->getRepository(Panier::class)->find($id);
        if ($panier) {
            $manager->remove($panier);
            $manager->flush();
        }

        // $repo = $this->getDoctrine()->getRepository(Panier::class);
        // return $this->json([
        //     // 'message' => 'Un aticle a été supprimé du panier',
        //     'count' => $repo->count(['user' => $this->getUser()])

        // ]);
         return $this->redirectToRoute('paquet');
    }


    /**
     * @Route("/panier/{id}", name="addPanier")
     * @IsGranted("ROLE_USER")
     */
    public function add(Article $article)
    {

        $panier = new Panier();
        $qte = 1;
        if ($this->getUser()) {
            $manager = $this->getDoctrine()->getManager();
            $item = $manager->getRepository(Panier::class)->findOneBy(['user' => $this->getUser(), 'article' => $article]);
            if ($item) {
                $qte = $item->getQte() + 1;
                $panier = $manager->getRepository(Panier::class)->find($item->getId());

                $panier->setQte($qte);
                $manager->flush();
            } else {

                $article = $manager->getRepository(Article::class)->find($article);

                $panier->setUser($this->getUser())
                    ->setArticle($article)
                    ->setQte(1);
                $manager->persist($panier);
                $manager->flush();
            }
        }
        $repo = $this->getDoctrine()->getRepository(Panier::class);
        // return $this->json([
        //     // 'message' => 'Un aticle a été ajouté au panier',
        //     'count' => $repo->count(['user' => $this->getUser()])
        // ]);
         return $this->redirectToRoute('paquet');
    }


    /**
     * @Route("/paquet", name="paquet")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request)
    {
        // Afficher tous les articles
        $totalpanier= new Total();
        $repo = $this->getDoctrine()->getRepository(Panier::class);
        $session = $request->getSession();
        $session->set('no', $repo->count(['user' => $this->getUser()]));
        // $repo = $this->getDoctrine()->getRepository(Panier::class);
        // $paniers = $repo->findBy(["user" => $this->getUser()]);
        $allpaniers = $repo->findBy(["user" => $this->getUser()]);
        $total = 0;
        foreach ($allpaniers as $row) {
            $total += (($row->getArticle()->getPrix()) * ($row->getQte())*1.05);
        }
        $totalpanier->setPrixPanier($total);
        $er = $this->getDoctrine()->getManager();
        $er->persist($totalpanier);
        $er->flush();

        $allpaniers = $repo->findBy(["user" => $this->getUser()]);
        if ($allpaniers) {

            return $this->render('panier/panier2.html.twig', [
                'paniers' => $allpaniers,
                'total'=>$total           
                ]);
        } else {
            return $this->redirectToRoute('paccueil');
        }
    }

// 
    public function total(Request $request)
     {   
        $totalpanier= new Total();
        $repo = $this->getDoctrine()->getRepository(Panier::class);
        $paniers = $repo->findBy(["user" => $this->getUser()]);
        $total = 0;
        foreach ($paniers as $row) {
            $total += ($row->getArticle()->getPrix()) * ($row->getQte());
        }
        // sotre the number of row in cart in session variable
        $session = $request->getSession();
        $session->set('no', $repo->count(['user' => $this->getUser()]));
        $session->set('total', $total);
        // $totalpanier->setPrixPanier($total);
        // $er = $this->getDoctrine()->getManager();
        // $er->persist($totalpanier);
        // $er->flush();
    }

    
}