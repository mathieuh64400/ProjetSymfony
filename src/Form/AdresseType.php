<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Adresse')
        ->add('Pays',CountryType::class)
        ->add('Ville')
        ->add('codePostal')
        ->add('user',EntityType::class,[
            'class'=> User::class,
            'choice_label'=>'Identifiant'
        ])
        ->add('typeAdresse',ChoiceType::class, array(
            'choices'=> array(
               'principale' =>1,
               ' secondaire ' =>0,
            ),
            'expanded' =>true,
            'multiple' => false
         ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
