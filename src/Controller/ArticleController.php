<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Ecoscore;
use App\Form\EditArticletType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
    /**
     * @Route("/paccueil", name="paccueil")
     * 
     */
    public function accueil(PaginatorInterface $paginator, Request $request )
    
    {   
       
        $articles = $paginator->paginate( $this-> getDoctrine()->getRepository(Article::class)->findAll(),
        $request->query->getInt('page',1),
        3);
        
        return $this->render('article/accueil.html.twig', [
            'controller_name' => 'RhumaController',
            'articles'=> $articles
        ]);
    }
    /**
     * @Route("/pnew", name="article_creation")
     * @Route("/pnew/{id}/edit",name="article_edit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function formarticle(Article $article = null, Request $request){
        // 
        if(!$article){
            $article= new Article();
        }
        $formulairebis=$this->createFormBuilder($article)
                    ->add('type')
                    ->add('titre')
                    ->add('Volume')
                    ->add('image')
                    ->add('description')
                    ->add('Prix')
                    ->add('category',EntityType::class,[
                        'class'=>Category::class,
                        'choice_label'=>'titre'
                    ])
                    ->add('ecoscore',EntityType::class,[
                        'class'=>Ecoscore::class,
                        'choice_label'=>'valeur'
                    ])
                    ->getForm();

        $formulairebis->handleRequest($request);
        dump($article);
        if($formulairebis->isSubmitted() && $formulairebis-> isValid())
        {
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('paccueil');
        }

        return $this->render('article/creat.html.twig', [
            'formPersobis' => $formulairebis->createView(),
            'editMode'=>$article->getId() !== null
        ]);
    
    }
 
    /**
     * @Route("/paccueil/{id}", name="paccueil_show")
     * @IsGranted("ROLE_USER")
     */
    public function show($id)
    {    $repo=$this->getDoctrine()-> getRepository(Article::class);
        $article=$repo->find($id);
        return $this->render('article/show.html.twig', [
            'controller_name' => 'RhumaController',
            'article'=>$article
        ]);
    }
     /**
     * @Route("/deleteArticle/{id}", name="deleteArticle")
     * @IsGranted("ROLE_ADMIN")
     */

    public function delete($id, Request $request)
    {
        // Supprimer un aticle de la vitrine
        $manager = $this->getDoctrine()->getManager();
        $article = $manager->getRepository(Article::class)->find($id);
        if ($article) {
            $manager->remove($article);
            $manager->flush();
        }
    return $this->redirectToRoute('paccueil');
    }
}

