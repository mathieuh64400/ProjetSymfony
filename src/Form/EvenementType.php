<?php

namespace App\Form;

use App\Entity\Nature;
use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Nom')
        ->add('date',DateType::class,[
            'widget' => 'choice',
        ])
        ->add('Contenu')
        ->add('Image')
        ->add('nature',EntityType::class,[
            'class'=> Nature::class,
            'choice_label'=>'Type'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
