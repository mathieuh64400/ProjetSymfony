<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class MailerController extends AbstractController
{
   /**
     * @Route("/mailer", name="mailer")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(MailerInterface $mailer)
    { $email = (new Email())
        ->from('contactrhumasug@gmail.com')
        ->to($this->getUser()->getEmail())
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Nos coordonnées Bancaires!!')
        ->text('')
        ->html('<p>Comme Attendu, nous vous envoyons nos coordonnées bancaires!
                <br>Un fichier avec  ces dernières est associé à ce message en pièce jointe! 
                <br>veuillez nous contactez pour nous signaler tous incidents sur ce message!!!!!!</p> ')
        ->attachFromPath('/path/to/documents/terms-of-use.pdf')
        ->embed(fopen('/public/assets/images/Group.png', 'r'), 'logo');

        $mailer->send($email);

        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
}
