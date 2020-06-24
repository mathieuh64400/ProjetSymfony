<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class LangueController extends AbstractController
{
   /**
 * @Route("/change_locale/{locale}", name="change_locale")
 * @IsGranted("ROLE_USER")
 */
public function changeLocale($locale, Request $request)
{
    // On stocke la langue dans la session
    $request->getSession()->set('_locale', $locale);

    // On revient sur la page précédente
    return $this->redirect($request->headers->get('referer'));
}
    }

