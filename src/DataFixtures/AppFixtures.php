<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Nature;
use App\Entity\Annonce;
use App\Entity\Contact;
use App\Entity\Evenement;
use App\Entity\PaieCommande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker= \Faker\Factory::create('fr-Fr');
        for($i=0;$i<10;$i++){
            $annonce = new Annonce();
            $annonce->setTitre($faker->word())
                    ->setNom($faker->name())
                    ->setContenu($faker->paragraph())
                    ->setDate($faker->dateTimeBetween('- 3 month'));
            $manager->persist($annonce);
        }
        for($j=0;$j<=mt_rand(4,9);$j++){
            $paie= new PaieCommande();
            $paie ->setMode($faker->randomDigit())
                    ->setNom($faker->name())
                    ->setEtat("Null")
                  ->setAdresse($faker->streetName())
                  ->setCryptogramme($faker->randomNumber())
                  ->setDateExpiration($faker->creditCardExpirationDate())
                  ->setNumeroCB($faker->creditCardNumber())
                  ->setDate($faker->dateTimeBetween('- 3 month'));
            $manager->persist($paie);
        }
        for($k=0;$k<=mt_rand(1,11);$k++){
            $contact=new Contact();
            $contact->setNom($faker->name())
                    ->setEmail($faker->email())
                    ->setTelephone($faker->phoneNumber())
                    ->setSujet($faker->sentence($nbWords = 6, $variableNbWords = true) )
                    ->setMessage($faker->text($maxNbChars = 200) )
                    ->setDate($faker->dateTimeBetween('- 3 month'));
            $manager->persist($contact);
        }
        for($l=0;$l<=mt_rand(1,12);$l++){
            $user= new User();
            $user->setEmail($faker->email())
                ->setIdentifiant($faker->word())
                 ->setPassword($faker->password())
                 ->setNom($faker->lastName())
                 ->setPrenom($faker->firstName())
                 ->setPays($faker->country())
                 ->setTelephone($faker->phoneNumber())
                 ->setDatedeNaissance($faker->dateTimeBetween('-50 years'))
                 ->setDatedInscription($faker->dateTimeBetween('-2 years'));
            $manager->persist($user);
        }
        for ($z=0;$z<5;$z++){
            $nature= new Nature();
            $nature->setType($faker->word());
            $manager->persist($nature);
        }
        for($l=0;$l<=mt_rand(1,12);$l++){
            $event= new Evenement();
            $event->setNom($faker->lastName())
                 ->setDate($faker->dateTimeBetween('-2 month'))
                 ->setImage($faker->imageUrl())
                 ->setContenu($faker->text($maxNbChars = 200))
                 ->setNature($nature);
            $manager->persist($event);
        }
        
        $manager->flush();
    }
}
