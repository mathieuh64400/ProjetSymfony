<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\EditContactType;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class ContactController extends AbstractController
{
    // /**
    //  * @Route("/contact", name="contact")
    //  */
    // public function index()
    // {
    //     return $this->render('contact/index.html.twig', [
    //         'controller_name' => 'ContactController',
    //     ]);
    // }
    /**
     * @Route("/voircontact", name="voirlescontact")
     * @IsGranted("ROLE_ADMIN")
     */
    public function voircontact(ContactRepository $contact)
    {
        return $this->render('contact/index.html.twig', [
            'contact' => $contact->findAll()]);
    }
     /**
     * @Route("/contact", name="contact")
     * @IsGranted("ROLE_USER")
     */
    public function contact(Request $request)
     {
        $contact= new Contact();
        $formcontact=$this->createFormBuilder($contact)
                   ->add('Nom')
                    ->add('email')
                    ->add('telephone',TelType::class)
                    ->add('sujet')
                    ->add('message',TextareaType::class)
                    ->add('date',DateType::class,[
                        'widget' => 'choice',
                    ])
                    ->getForm();

        $formcontact->handleRequest($request);
        dump($contact);
        if($formcontact->isSubmitted() && $formcontact-> isValid())
        {
            $manager= $this->get("doctrine")->getManager();
            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute('paccueil');
        }
        return $this->render('contact/contact.html.twig', [
            'formcontact' => $formcontact->createView(),
        ]);
    }
/**
 * @Route("/contact/modifier/{id}", name="contact_status")
 * @IsGranted("ROLE_ADMIN")
 */
public function editContact(Contact $contact, Request $request)
{
    $form = $this->createForm(EditContactType::class, $contact);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();

        $this->addFlash('message', 'Status du message modifié avec succès');
        return $this->redirectToRoute('voirlescontact');
    }
    
    return $this->render('contact/editcontact.html.twig', [
        'contact' => $form->createView(),
    ]);
}
}
