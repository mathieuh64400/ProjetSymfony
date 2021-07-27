<?php

namespace App\Form;

use App\Entity\Calendare;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text'
            ], ['label' => 'Debut du rendez-vous'])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text'
            ], ['label' => 'Fin du rendez-vous'])
            ->add('description', TextareaType::class, ['label' => 'Description'])
            ->add('all_day')

            ->add('background_color', ColorType::class, ['label' => 'Couleur selon la nature du rendez-vous']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendare::class,
        ]);
    }
}
