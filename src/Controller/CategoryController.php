<?php

namespace App\Controller;

use App\Entity\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class CategoryController extends AbstractController
{
     /**
     * @Route("/category", name="category")
     * @IsGranted("ROLE_USER")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $category = $paginator->paginate( $this-> getDoctrine()->getRepository(Category::class)->findAll(),
        $request->query->getInt('page',1),
        3);
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'category'=>$category
        ]);
    }
    /**
     * @Route("/pnewcategory", name="category_creation")
     * @IsGranted("ROLE_ADMIN")
     */
    public function creationarticle(Request $request){
        $category= new Category();
        $formulairebis=$this->createFormBuilder($category)
                    ->add('titre')
                    ->add('description')
                    ->getForm();

        $formulairebis->handleRequest($request);
        dump($category);
        if($formulairebis->isSubmitted() && $formulairebis-> isValid())
        {
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('category');
        }

        return $this->render('category/creation.html.twig', [
            'formcategory' => $formulairebis->createView(),
        ]);
    
    }
}
