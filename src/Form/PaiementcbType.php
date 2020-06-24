<?php

namespace App\Form;

use App\Entity\PaieCommande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PaiementcbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        // ->add('status',ChoiceType::class, array(
        //     'choices'=> array(
        //        'Non_Traité' =>3,
        //        ' En cours de traitement' =>2,
        //        ' en transit' =>1,
        //        ' Remis ' =>0
        //     ),
        //     'expanded' =>true,
        //     'multiple' => false
        //  ))
         ->add('etat')
        ->add('valider', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PaieCommande::class,
        ]);
    }
}
