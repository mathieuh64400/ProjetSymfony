<?php
namespace App\EventListener;

use App\Entity\PaieCommande;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\EventListener\PaieCommandeListener;
use App\Service\EncryptService;

class DoctrineListener
{
    //accès au service
    private $encryptService;
    public function __construct(EncryptService $encryptService)
    {
        $this->encryptService = $encryptService;
    }

    // Méthodes écoutées : 
    // - prePersist et preUpdate avant l'enregistrement des entités
    // - postLoad après le chargement des entités
    // Dans chacune, on récupère l'entité des arguments passées
    // Et on teste s'il s'agit d'une entité protégée (ici Client)

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject(); 
        if ($entity instanceof PaieCommande) {
            $this->encryptFields($entity);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof PaieCommande) {
            $this->encryptFields($entity);
        }
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof PaieCommande) {
            $this->decryptFields($entity);
        }
    }  

    // Méthode de chiffrement des propriétés du Client
    private function encryptFields(PaieCommande $client)
    {
                // $modecrypt = $this->encryptService->encrypt( $client->getMode());
                $Nomcrypt = $this->encryptService->encrypt( $client->getNom());
                $numeroCBcrypt = $this->encryptService->encrypt( $client->getNumeroCB());
                // $dateExpirationcrypt = $this->encryptService->encrypt( $client->getDateExpiration());
                $cryptogrammecrypt = $this->encryptService->encrypt( $client->getCryptogramme());
                // $datecrypt = $this->encryptService->encrypt( $client->getDate());
                // $client->setmode($modecrypt);
                $client->setNom($Nomcrypt);
                $client->setNumeroCB($numeroCBcrypt);
                $client->setCryptogramme($cryptogrammecrypt);
                return $client;
            }

    // Méthode de déchiffrement des propriétés du Client
    private function decryptFields(PaieCommande $client)
    {
        // $modeclair = $this->encryptService->decrypt( $client->getMode());  
        $Nomclair = $this->encryptService->decrypt( $client->getNom()); 
        $numeroCBclair = $this->encryptService->decrypt( $client->getNumeroCB()); 
        $cryptogrammeclair = $this->encryptService->decrypt( $client->getCryptogramme()); 
        // $client->setMode($modeclair);
        $client->setNom($Nomclair);
        $client->setNumeroCB($numeroCBclair);
        $client->setCryptogramme($cryptogrammeclair);
        return $client;
    }
} 