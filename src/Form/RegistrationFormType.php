<?php

namespace App\Form;

// use App\Entity\User;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email')
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'You should agree to our terms.',
                ]),
            ],
        ])
        ->add('password', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('Identifiant',TextareaType::class)
        ->add('civilite',ChoiceType::class,array(
            'choices'=> array(
               'Mr' =>1,
               'Mme' =>0
            ),
            'expanded' =>true,
            'multiple' => false))
        ->add('Nom')
        ->add('Prenom')
        ->add('Pays',CountryType::class)
        ->add('telephone',TelType::class)
        ->add('datedeNaissance',DateType::class,[
            'label' => 'date_de_naissance',
            'widget'=>'single_text',
            'input' => 'datetime',
            'html5' => 'false',
            'constraints' => [new NotBlank(['message'=>'rentrez une date!']),
                 new NotNull(['message'=>'rentrez une date!'])],
         ])
      
        ->add('datedInscription',DateType::class,[
            'widget' => 'choice',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
